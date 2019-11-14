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
use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * Class query
 *
 * This class is used to define <query> </query> in xml code
 */
class QueryXmlTag extends AbstractXmlTag
{

    /**
     * Sets the query manager
     * .
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setQueryManager(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the attributes
        $name = null;
        $uid = null;
        $markers = [];
        foreach ($element->attributes() as $attributeKey => $attribute) {
            if ($attributeKey == 'name') {
                $name = (string) $attribute;
            } elseif ($attributeKey == 'uid') {
                $uid = (string) $attribute;
            } else {
                $match = [];
                if (preg_match('/^marker#(\w*)$/', (string) $attribute, $match)) {
                    $attribute = XmlParser::getValueFromReference((string) $attribute);
                    $markers[$attributeKey] = $attribute;
                } elseif (preg_match('/^(\w+)#(data|marker)#(\w+)((:)(?:(\d+)))?$/', (string) $attribute, $match)) {
                    $attribute = XmlParser::getValueFromReference($match[2], $match[3], ($match[6] ? $match[6] : 0));
                    $markers[$attributeKey] = $attribute;
                } elseif (preg_match('/^(\w+)#(.*)$/', (string) $attribute, $match)) {
                    $markers[$match[1]] = $match[2];
                } else {
                    $markers[$attributeKey] = (string) $attribute;
                }
            }
        }

        // Checks if the attribute name exists
        if ($name === null) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'name',
                $elementName
            ]);
        }
        if (XmlParser::isReference($name) !== false) {
            $name = XmlParser::getValueFromReference($name);
        }

        // Checks if the attribute uid exists
        if ($uid === null) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'uid',
                $elementName
            ]);
        }
        if (XmlParser::isReference($uid) !== false) {
            $uid = XmlParser::getValueFromReference($uid);
        }

        // Processes the query
        $this->xmlTagValue = $this->xmlParser->processQuery($name, $uid, $markers);
    }
}
?>
