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

use TYPO3\CMS\Core\Utility\CsvUtility;
use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * Class for Charts
 *
 * This class is used to define <charts> </charts> in xml code
 */
class ChartsXmlTag extends AbstractXmlTag
{

    /**
     * Adds an item to a data array
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function addItem(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Checks if there is a reference
        $reference = (string) $element->attributes()->reference;
        if (empty($reference)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'reference',
                $elementName
            ]);
        }

        // Checks if there is a key
        $key = (string) $element->attributes()->key;
        if ($key == '') {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'key',
                $elementName
            ]);
        }
        if (XmlParser::isReference($key) !== false) {
            $key = XmlParser::getValueFromReference($key);
        }

        // Checks if there is a value
        $value = (string) $element->attributes()->value;
        if ($value == '') {
            if ((string) $element == '') {
                return XmlParser::getController()->addError('error.missingAttribute', [
                    'value',
                    $elementName
                ]);
            } else {
                $value = (string) $element;
            }
        } elseif (XmlParser::isReference($value) !== false) {
            $value = XmlParser::getValueFromReference($value);
        }

        // Gets the reference parts
        $referenceParts = explode('#', $reference);
        $xmlTag = $referenceParts[0];
        $id = $referenceParts[1];

        // Performs the change in the xml tag results array
        $xmlTagResult = XmlParser::getXmlTagResult($xmlTag, $id);
        if ($xmlTagResult === null) {
            return XmlParser::getController()->addError('error.incorrectReferenceValue', [
                $xmlTag,
                $id
            ]);
        }

        // Gets the xml tag value
        $xmlTagValue = $xmlTagResult->getXmlTagValue();

        // Adds the item
        $xmlTagValue[$key] = $value;

        // Updates the xml tag result
        $xmlTagResult->setXmlTagValue($xmlTagValue);
    }

    /**
     * Sets a new id to an element with a reference
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setId(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Checks if there is a reference
        $reference = (string) $element->attributes()->reference;
        if (empty($reference)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'reference',
                $elementName
            ]);
        }

        $newId = (string) $element->attributes()->newId;
        if (empty($newId)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'newId',
                $elementName
            ]);
        }
        if (XmlParser::isReference($newId) !== false) {
            $newId = XmlParser::getValueFromReference($newId);
        }

        // Gets the reference parts
        $referenceParts = explode('#', $reference);
        $xmlTag = $referenceParts[0];
        $id = $referenceParts[1];

        // Performs the change in the xml tag results array
        $xmlTagResult = XmlParser::getXmlTagResult($xmlTag, $id);
        if ($xmlTagResult === null) {
            return XmlParser::getController()->addError('error.incorrectReferenceValue', [
                $xmlTag,
                $id
            ]);
        }
        $xmlTagResult->setXmlTagId($newId);
        XmlParser::setXmlTagResult($xmlTag, $newId, $xmlTagResult);
        XmlParser::clearXmlTagResult($xmlTag, $id);
    }

    /**
     * Exports data in csv
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function exportCSV(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Checks if there is a reference attribute
        $reference = (string) $element->attributes()->reference;
        if (empty($reference)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'reference',
                $elementName
            ]);
        }

        // Checks if there is a data attribute
        $data = (string) $element->attributes()->data;
        if (empty($data)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'data',
                $elementName
            ]);
        }
        $data = XmlParser::getValueFromReference($data);
        if ($data === false) {
            return;
        }
        $data = XmlParser::ResolveValueByReference($data);

        // Checks if there is a row header attribute
        $rowHeader = (string) $element->attributes()->rowHeader;
        if (! empty($rowHeader)) {
            $rowHeader = XmlParser::getValueFromReference($rowHeader);
            if ($rowHeader === false) {
                return;
            }
        }

        // Checks if there is a column header attribute
        $columnHeader = (string) $element->attributes()->columnHeader;
        if (! empty($columnHeader)) {
            $columnHeader = XmlParser::getValueFromReference($columnHeader);
            if ($columnHeader === false) {
                return;
            }
            $columnHeader = XmlParser::ResolveValueByReference($columnHeader);
        }

        // Sets the row header
        $output = [];
        if (! empty($columnHeader)) {
            $rowHeader = array_merge([
                ''
            ], $rowHeader);
        }

        if (! is_array($rowHeader)) {
            return XmlParser::getController()->addError('error.exportCsv', [
                'rowHeader'
            ]);
        }
        $output[] = CsvUtility::csvValues($rowHeader, ';');

        // Sets the rows
        if (! is_array($data[0])) {
            // Table with one row
            if (! is_array($data)) {
                return XmlParser::getController()->addError('error.exportCsv', [
                    'data'
                ]);
            }
            $output[] = CsvUtility::csvValues($data, ';');
        } else {
            // Table with several rows
            foreach ($data as $rowKey => $row) {
                if (! is_array($row)) {
                    return XmlParser::getController()->addError('error.exportCsv', [
                        'data[' . $rowKey . ']'
                    ]);
                }
                if (! empty($columnHeader)) {
                    $value = array_merge([
                        $columnHeader[$rowKey]
                    ], $row);
                    $output[] = CsvUtility::csvValues($value, ';');
                } else {
                    $output[] = CsvUtility::csvValues($row, ';');
                }
            }
        }

        $outputString = implode(chr(10), $output);

        // Checks if an encoding is required, default is ISO-8859-1
        $toEncoding = (string) $element->attributes()->encoding;
        if (empty($toEncoding)) {
            $toEncoding = 'ISO-8859-1';
        }
        if (XmlParser::isReference($toEncoding) !== false) {
            $toEncoding = XmlParser::getValueFromReference($toEncoding);
        }
        $fromEncoding = mb_detect_encoding($outputString);
        $outputString = mb_convert_encoding($outputString, $toEncoding, $fromEncoding);

        // Gets the reference parts
        $referenceParts = explode('#', $reference);
        $xmlTag = $referenceParts[0];
        $id = $referenceParts[1];

        // Performs the change in the xml tag results array
        $xmlTagResult = XmlParser::getXmlTagResult($xmlTag, $id);
        if ($xmlTagResult === null) {
            return XmlParser::getController()->addError('error.incorrectReferenceValue', [
                $xmlTag,
                $id
            ]);
        }

        // Gets the xml tag value
        $xmlTagValue = $xmlTagResult->getXmlTagValue();

        // Adds the title
        $xmlTagValue['csv'] = $outputString;

        // Updates the xml tag result
        $xmlTagResult->setXmlTagValue($xmlTagValue);
    }
}
