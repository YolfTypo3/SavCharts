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
 * The TYPO3 project - inspiring people to share!
 */

namespace YolfTypo3\SavCharts\XmlParser\GeneralXmlTag;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * The abstract tag class
 */
abstract class AbstractXmlTag
{
    /**
     * Xml Parser
     *
     * @var XmlParser
     */
    protected XmlParser $xmlParser;

    /**
     * The value associated with the tag
     *
     * @var mixed
     */
    protected mixed $xmlTagValue = null;

    /**
     * The tag id
     *
     * @var mixed
     */
    protected mixed $xmlTagId = '0';

    /**
     * The overload flag
     *
     * @var bool
     */
    protected bool $overload = false;

    /**
     * Construtor
     *
     * @return void
     */
    public function __construct()
    {
        $this->xmlParser = GeneralUtility::makeInstance(XmlParser::class);
    }

    /**
     * Default method
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function defaultMethod(\SimpleXMLElement $element): void
    {

    }

    /**
     * Gets the xml tag value
     *
     * @return mixed
     */
    public function getXmlTagValue(): mixed
    {
        return $this->xmlTagValue;
    }

    /**
     * Sets the xml tag value
     *
     * @param mixed $xmlTagValue
     * 
     * @return void
     */
    public function setXmlTagValue(mixed $xmlTagValue): void
    {
        $this->xmlTagValue = $xmlTagValue;
    }

    /**
     * Sets the xml tag id
     *
     * @param mixed $xmlTagId
     * 
     * @return void
     */
    public function setXmlTagId(mixed $xmlTagId): void
    {
        $this->xmlTagId = $xmlTagId;
    }

    /**
     * Gets the overload flag
     *
     * @return bool
     */
    public function getOverload() : bool
    {
        return $this->overload;
    }

    /**
     *  Sets the overloadIsAllowed flag
     *
     * @param bool $overload
     * 
     * @return void
     */
    public function setOverload(bool $overload): void
    {
        $this->overload = $overload;
    }
}
