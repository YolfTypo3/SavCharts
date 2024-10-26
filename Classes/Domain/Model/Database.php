<?php

declare(strict_types=1);

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

namespace YolfTypo3\SavCharts\Domain\Model;

/**
 * Database model for the extension SavCharts
 *
 */
class Database extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \YolfTypo3\SavCharts\Domain\Repository\DatabaseRepository
     */
    protected $repository = null;

    /**
     * The <title> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $title;

    /**
     * The <driver> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $driver;

    /**
     * The <tables> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $tables;

    /**
     * The <host> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $host;

    /**
     * The <port> variable.
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("Integer")
     */
    protected $port;

    /**
     * The <socket> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $socket;

    /**
     * The <name> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $name;

    /**
     * The <username> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $username;

    /**
     * The <userpassword> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("String")
     */
    protected $userpassword;

    /**
     * The <persistent> variable.
     *
     * @var bool
     *
     */
    protected $persistent;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }


    /**
     * Getter for property <title>.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Setter for property <title>.
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * Getter for property <driver>.
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Setter for property <driver>.
     *
     * @param string $driver
     * @return void
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }


    /**
     * Getter for property <tables>.
     *
     * @return string
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Setter for property <tables>.
     *
     * @param string $tables
     * @return void
     */
    public function setTables($tables)
    {
        $this->tables = $tables;
    }


    /**
     * Getter for property <host>.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Setter for property <host>.
     *
     * @param string $host
     * @return void
     */
    public function setHost($host)
    {
        $this->host = $host;
    }


    /**
     * Getter for property <port>.
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Setter for property <port>.
     *
     * @param int $port
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }


    /**
     * Getter for property <socket>.
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Setter for property <socket>.
     *
     * @param string $socket
     * @return void
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }


    /**
     * Getter for property <name>.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for property <name>.
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Getter for property <username>.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Setter for property <username>.
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * Getter for property <userpassword>.
     *
     * @return string
     */
    public function getUserpassword()
    {
        return $this->userpassword;
    }

    /**
     * Setter for property <userpassword>.
     *
     * @param string $userpassword
     * @return void
     */
    public function setUserpassword($userpassword)
    {
        $this->userpassword = $userpassword;
    }


    /**
     * Getter for property <persistent>.
     *
     * @return bool
     */
    public function getPersistent()
    {
        return $this->persistent;
    }

    /**
     * Setter for property <persistent>.
     *
     * @param bool $persistent
     * @return void
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

}