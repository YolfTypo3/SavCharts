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
 * Database model for the extension SavCharts
 *
 */
class Database extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * The title variable.
     *
     * @var string
     */
    protected $title;

    /**
     * The driver variable.
     *
     * @var string
     */
    protected $driver;

    /**
     * The tables variable.
     *
     * @var string
     */
    protected $tables;

    /**
     * The host variable.
     *
     * @var string
     */
    protected $host;

    /**
     * The port variable.
     *
     * @var integer
     */
    protected $port;

    /**
     * The socket variable.
     *
     * @var string
     */
    protected $socket;

    /**
     * The name variable.
     *
     * @var string
     */
    protected $name;

    /**
     * The username variable.
     *
     * @var string
     */
    protected $username;

    /**
     * The userpassword variable.
     *
     * @var string
     */
    protected $userpassword;

    /**
     * The persistent variable.
     *
     * @var boolean
     */
    protected $persistent;

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
     * Getter for driver.
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Setter for driver.
     *
     * @param string $driver
     * @return void
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * Getter for tables.
     *
     * @return string
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Setter for tables.
     *
     * @param string $tables
     * @return void
     */
    public function setTables($tables)
    {
        $this->tables = $tables;
    }

    /**
     * Getter for host.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Setter for host.
     *
     * @param string $host
     * @return void
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Getter for port.
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Setter for port.
     *
     * @param integer $port
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Getter for socket.
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Setter for socket.
     *
     * @param string $socket
     * @return void
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * Getter for name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name.
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Setter for username.
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Getter for userpassword.
     *
     * @return string
     */
    public function getUserpassword()
    {
        return $this->userpassword;
    }

    /**
     * Setter for userpassword.
     *
     * @param string $userpassword
     * @return void
     */
    public function setUserpassword($userpassword)
    {
        $this->userpassword = $userpassword;
    }

    /**
     * Getter for persistent.
     *
     * @return boolean
     */
    public function getPersistent()
    {
        return $this->persistent;
    }

    /**
     * Setter for persistent.
     *
     * @param boolean $persistent
     * @return void
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

}
