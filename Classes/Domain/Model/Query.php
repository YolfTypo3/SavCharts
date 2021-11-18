<?php

namespace YolfTypo3\SavCharts\Domain\Model;

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
 * The TYPO3 project - inspiring people to share
 */

/**
 * Query model for the extension SavCharts
 *
 */
class Query extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * The title variable.
     *
     * @var string
     */
    protected $title;

    /**
     * The databaseId variable.
     *
     * @var \YolfTypo3\SavCharts\Domain\Model\Database
     */
    protected $databaseId;

    /**
     * The selectClause variable.
     *
     * @var string
     */
    protected $selectClause;

    /**
     * The fromClause variable.
     *
     * @var string
     */
    protected $fromClause;

    /**
     * The whereClause variable.
     *
     * @var string
     */
    protected $whereClause;

    /**
     * The groupbyClause variable.
     *
     * @var string
     */
    protected $groupbyClause;

    /**
     * The orderbyClause variable.
     *
     * @var string
     */
    protected $orderbyClause;

    /**
     * The limitClause variable.
     *
     * @var string
     */
    protected $limitClause;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Getter for title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Setter for title.
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Getter for databaseId.
     *
     * @return \YolfTypo3\SavCharts\Domain\Model\Database
     */
    public function getDatabaseId()
    {
        return $this->databaseId;
    }

    /**
     * Setter for databaseId.
     *
     * @param \YolfTypo3\SavCharts\Domain\Model\Database     $databaseId
     * @return void
     */
    public function setDatabaseId($databaseId)
    {
        $this->databaseId = $databaseId;
    }

    /**
     * Getter for selectClause.
     *
     * @return string
     */
    public function getSelectClause()
    {
        return $this->selectClause;
    }

    /**
     * Setter for selectClause.
     *
     * @param string $selectClause
     * @return void
     */
    public function setSelectClause($selectClause)
    {
        $this->selectClause = $selectClause;
    }

    /**
     * Getter for fromClause.
     *
     * @return string
     */
    public function getFromClause()
    {
        return $this->fromClause;
    }

    /**
     * Setter for fromClause.
     *
     * @param string $fromClause
     * @return void
     */
    public function setFromClause($fromClause)
    {
        $this->fromClause = $fromClause;
    }

    /**
     * Getter for whereClause.
     *
     * @return string
     */
    public function getWhereClause()
    {
        // @extensionScannerIgnoreLine
        return $this->whereClause;
    }

    /**
     * Setter for whereClause.
     *
     * @param string $whereClause
     * @return void
     */
    public function setWhereClause($whereClause)
    {
        // @extensionScannerIgnoreLine
        $this->whereClause = $whereClause;
    }

    /**
     * Getter for groupbyClause.
     *
     * @return string
     */
    public function getGroupbyClause()
    {
        return $this->groupbyClause;
    }

    /**
     * Setter for groupbyClause.
     *
     * @param string $groupbyClause
     * @return void
     */
    public function setGroupbyClause($groupbyClause)
    {
        $this->groupbyClause = $groupbyClause;
    }

    /**
     * Getter for orderbyClause.
     *
     * @return string
     */
    public function getOrderbyClause()
    {
        return $this->orderbyClause;
    }

    /**
     * Setter for orderbyClause.
     *
     * @param string $orderbyClause
     * @return void
     */
    public function setOrderbyClause($orderbyClause)
    {
        $this->orderbyClause = $orderbyClause;
    }

    /**
     * Getter for limitClause.
     *
     * @return string
     */
    public function getLimitClause()
    {
        return $this->limitClause;
    }

    /**
     * Setter for limitClause.
     *
     * @param string $limitClause
     * @return void
     */
    public function setLimitClause($limitClause)
    {
        $this->limitClause = $limitClause;
    }

}
