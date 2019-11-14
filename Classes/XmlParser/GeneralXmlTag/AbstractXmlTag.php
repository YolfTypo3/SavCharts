<?php
namespace YolfTypo3\SavCharts\XmlParser\GeneralXmlTag;

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
     * @var \YolfTypo3\SavCharts\XmlParser\XmlParser
     */
    protected $xmlParser;

    /**
     * The value associated with the tag
     *
     * @var mixed
     */
    protected $xmlTagValue = null;

    /**
     * The tag id
     *
     * @var string
     */
    protected $xmlTagId = '0';

    /**
     * The overload flag
     *
     * @var bool
     */
    protected $overload = false;

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
    public function defaultMethod(\SimpleXMLElement $element)
    {

    }

    /**
     * Gets the xml tag value
     *
     * @return mixed
     */
    public function getXmlTagValue()
    {
        return $this->xmlTagValue;
    }

    /**
     * Sets the xml tag value
     *
     * @param mixed $xmlTagValue
     * @return void
     */
    public function setXmlTagValue($xmlTagValue)
    {
        $this->xmlTagValue = $xmlTagValue;
    }

    /**
     * Sets the xml tag id
     *
     * @param string $xmlTagId
     * @return void
     */
    public function setXmlTagId($xmlTagId)
    {
        $this->xmlTagId = $xmlTagId;
    }

    /**
     * Gets the overload flag
     *
     * @return boolean
     */
    public function getOverload() : bool
    {
        return $this->overload;
    }

    /**
     *  Sets the overloadIsAllowed flag
     *
     * @param bool $overload
     * @return void
     */
    public function setOverload(bool $overload)
    {
        $this->overload = $overload;
    }
}
?>
