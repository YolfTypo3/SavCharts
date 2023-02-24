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

namespace YolfTypo3\SavCharts\XmlParser\GeneralXmlTag;

use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * Class marker
 *
 * This class is used to define <marker> </marker> in xml code
 */
class MarkerXmlTag extends AbstractXmlTag
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
        $value = (string) $element;
        $child = $element->addChild('setMarker');
        $attributes = $element->attributes();
        if ($value != '' || isset($attributes['value'])) {
            $child->addAttribute('value', $value);
        }
        $this->setMarker($child);
    }

    /**
     * Sets a marker
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setMarker(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the attribute
        $attributes = $element->attributes();
        if (! isset($attributes['value'])) {
            return  XmlParser::getController()->addError(
                'error.missingAttribute',
                [
                    'value',
                    $elementName
                ]
            );
        } else {
            $value = (string) $element->attributes()->value;
        }
        if (XmlParser::isReference($value) !== false) {
            $value = XmlParser::getValueFromReference($value);
        }
        $marker = XmlParser::replaceSpecialChars($value);
        $this->xmlTagValue = $marker;
    }

    /**
     * Sets a marker by pieces
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setMarkerByPieces(\SimpleXMLElement $element)
    {
        // Builds the marker string from the parameters
        $markers = '';
        foreach ($element->attributes() as $attributeKey => $attribute) {
            $marker = (string) $attribute;
            if ( XmlParser::isReference($marker) !== false) {
                $marker = XmlParser::getValueFromReference($marker);
            }
            $markers .= $marker;
        }

        $markers = XmlParser::replaceSpecialChars($markers);
        $this->xmlTagValue = $markers;
    }
}
