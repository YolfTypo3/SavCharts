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

namespace YolfTypo3\SavCharts\XmlParser\ChartXmlTag;

/**
 * Abstract class for Chart tags
 *
 */
use YolfTypo3\SavCharts\XmlParser\GeneralXmlTag\AbstractXmlTag;
use YolfTypo3\SavCharts\XmlParser\XmlParser;


abstract class AbstractChartXmlTag extends AbstractXmlTag
{
    /**
     * Default method
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function defaultMethod(\SimpleXMLElement $element)
    {
        $this->postProcessingMethod();
    }

    /**
     * Post processing method
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function postProcessingMethod(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the width
        $width = (string) $element->attributes()->width;
        if (XmlParser::isReference($width) !== false) {
            $width = XmlParser::getValueFromReference($width);
        } elseif (empty($width)) {
            $width = 400;
        }
        if (XmlParser::isReference($width) !== false) {
            $width = XmlParser::getValueFromReference($width);
        }
        $this->xmlTagValue['width'] = $width;

        // Gets the height
        $height = (string) $element->attributes()->height;
        if (XmlParser::isReference($height) !== false) {
            $height = XmlParser::getValueFromReference($height);
        } elseif  (empty($height)) {
            $height = 300;
        }
        if (XmlParser::isReference($height) !== false) {
            $height = XmlParser::getValueFromReference($height);
        }
        $this->xmlTagValue['height'] = $height;

        // Gets the data
        $data = (string) $element->attributes()->data;
        if (empty($data)) {
            return XmlParser::getController()->addError(
                'error.missingAttribute',
                [
                    'data',
                    $elementName
                ]
            );
        }
        $this->xmlTagValue['data'] = $data;

        // Gets the options
        $options = (string) $element->attributes()->options;
        $this->xmlTagValue['options'] = $options;
    }

}
