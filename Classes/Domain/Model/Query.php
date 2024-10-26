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
 * Query model for the extension SavCharts
 *
 */
class Query extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \YolfTypo3\SavCharts\Domain\Repository\QueryRepository
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
     * The <databaseId> variable.
     *
     * @var \YolfTypo3\SavCharts\Domain\Model\Database
     *
     */
    protected $databaseId;

    /**
     * The <selectClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $selectClause;

    /**
     * The <fromClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $fromClause;

    /**
     * The <whereClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $whereClause;

    /**
     * The <groupbyClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $groupbyClause;

    /**
     * The <orderbyClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $orderbyClause;

    /**
     * The <limitClause> variable.
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("Text")
     */
    protected $limitClause;

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
     * Getter for property <databaseId>.
     *
     * @return \YolfTypo3\SavCharts\Domain\Model\Database
     */
    public function getDatabaseId()
    {
        return $this->databaseId;
    }

    /**
     * Setter for property <databaseId>.
     *
     * @param \YolfTypo3\SavCharts\Domain\Model\Database $databaseId
     * @return void
     */
    public function setDatabaseId($databaseId)
    {
        $this->databaseId = $databaseId;
    }


    /**
     * Getter for property <selectClause>.
     *
     * @return string
     */
    public function getSelectClause()
    {
        return $this->selectClause;
    }

    /**
     * Setter for property <selectClause>.
     *
     * @param string $selectClause
     * @return void
     */
    public function setSelectClause($selectClause)
    {
        $this->selectClause = $selectClause;
    }


    /**
     * Getter for property <fromClause>.
     *
     * @return string
     */
    public function getFromClause()
    {
        return $this->fromClause;
    }

    /**
     * Setter for property <fromClause>.
     *
     * @param string $fromClause
     * @return void
     */
    public function setFromClause($fromClause)
    {
        $this->fromClause = $fromClause;
    }


    /**
     * Getter for property <whereClause>.
     *
     * @return string
     */
    public function getWhereClause()
    {
        return $this->whereClause;
    }

    /**
     * Setter for property <whereClause>.
     *
     * @param string $whereClause
     * @return void
     */
    public function setWhereClause($whereClause)
    {
        $this->whereClause = $whereClause;
    }


    /**
     * Getter for property <groupbyClause>.
     *
     * @return string
     */
    public function getGroupbyClause()
    {
        return $this->groupbyClause;
    }

    /**
     * Setter for property <groupbyClause>.
     *
     * @param string $groupbyClause
     * @return void
     */
    public function setGroupbyClause($groupbyClause)
    {
        $this->groupbyClause = $groupbyClause;
    }


    /**
     * Getter for property <orderbyClause>.
     *
     * @return string
     */
    public function getOrderbyClause()
    {
        return $this->orderbyClause;
    }

    /**
     * Setter for property <orderbyClause>.
     *
     * @param string $orderbyClause
     * @return void
     */
    public function setOrderbyClause($orderbyClause)
    {
        $this->orderbyClause = $orderbyClause;
    }


    /**
     * Getter for property <limitClause>.
     *
     * @return string
     */
    public function getLimitClause()
    {
        return $this->limitClause;
    }

    /**
     * Setter for property <limitClause>.
     *
     * @param string $limitClause
     * @return void
     */
    public function setLimitClause($limitClause)
    {
        $this->limitClause = $limitClause;
    }

}