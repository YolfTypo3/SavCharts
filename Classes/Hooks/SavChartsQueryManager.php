<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace YolfTypo3\SavCharts\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Hook for the query manager "savcharts"
 */
class SavChartsQueryManager extends AbstractQueryManager
{

    /**
     * Database connection
     *
     * @var \TYPO3\CMS\Core\Database\Connection
     */
    protected $databaseConnection = null;

    /**
     * Executes the query
     *
     * @param int $queryId
     *            The query id
     *
     * @return array The rows
     */
    public function executeQuery(int $queryId): array
    {
        // Initializes the query
        if (! $this->initialize($queryId)) {
            return [];
        }

        // Builds the query
        $query = 'SELECT ' . $this->query['selectClause'] .
            ' FROM ' . $this->query['fromClause'] .
            ($this->query['whereClause'] ? ' WHERE ' . $this->query['whereClause'] : '') .
            ($this->query['groupbyClause'] ? ' GROUP BY ' . $this->query['groupbyClause'] : '') .
            ($this->query['orderbyClause'] ? ' ORDER BY ' . $this->query['orderbyClause'] : '') .
            ($this->query['limitClause'] ? ' LIMIT ' . $this->query['limitClause'] : '');

        $rows = $this->databaseConnection->query($query)->fetchAll();

        if ($rows === null) {
            $this->controller->addError('error.queryReturnedNull', [
                $queryId
            ]);
        }
        return $rows;
    }

    /**
     * Initialization
     *
     * @param int $queryId
     *            The query id
     *
     * @return bool
     */
    protected function initialize(int $queryId): bool
    {
        // Gets the object
        $object = $this->controller->getQueryRepository()->findByUid($queryId);
        if ($object === null) {
            $this->controller->addError('error.queryError', [
                $queryId
            ]);
            return false;
        }

        // Gets the query
        $this->query['selectClause'] = trim($object->getSelectClause());
        $this->query['fromClause'] = trim($object->getFromClause());
        $this->query['whereClause'] = trim($object->getWhereClause());
        $this->query['groupbyClause'] = trim($object->getGroupbyClause());
        $this->query['orderbyClause'] = trim($object->getOrderbyClause());
        $this->query['limitClause'] = trim($object->getLimitClause());

        // Replaces the markers
        $this->replaceMarkersInQuery($queryId);

        // Finds one table for the connection: either the first table in the FROM clause or the first table after FROM
        // in case of subqueries. It means that all tables in the query have to belong to the same connection.
        $match = [];
        if (preg_match('/^(?is:(\w+)|.*?FROM\s+(\w+))/', $this->query['fromClause'], $match) > 0) {
            $tableForConnection = $match[2] ?? $match[1];
        } else {
            $this->controller->addError('error.tableNotFound', [
                $this->query['fromClause']
            ]);
            return false;
        }

        // Processes the database
        $databaseId = $object->getDatabaseId();

        if (! empty($databaseId)) {
            $title = trim($databaseId->getTitle());
            $driver = $databaseId->getDriver();
            $host = $databaseId->getHost();
            $port = $databaseId->getPort();
            $socket = $databaseId->getSocket();
            $name = $databaseId->getName();
            $username = $databaseId->getUsername();
            $userpassword = $databaseId->getUserpassword();

            // Processes connection
            $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections'][$title] = [
                'charset' => 'utf8',
                'dbname' => $name,
                'driver' => (empty($driver) ? 'mysqli' : $driver),
                'host' => $host,
                'port' => $port,
                'unix_socket' => $socket,
                'user' => $username,
                'password' => $userpassword
            ];

            // Creates the table handler for the database
            $tables = explode(chr(10), str_replace(chr(13), '', $databaseId->getTables()));
            foreach ($tables as $table) {
                $GLOBALS['TYPO3_CONF_VARS']['DB']['TableMapping'][trim($table)] = $title;
            }
        }

        $this->databaseConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($tableForConnection);
        $this->databaseConnection->connect();
        if (! $this->databaseConnection->isConnected()) {
            $this->controller->addError('error.databaseConnectionFailed', [
                $name
            ]);
        }
        return $this->databaseConnection->isConnected();
    }
}
