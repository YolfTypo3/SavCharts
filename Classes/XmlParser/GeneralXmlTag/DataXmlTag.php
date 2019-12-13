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
 * Class file
 *
 * This class is used to define <file> </file> in xml code
 */
class DataXmlTag extends AbstractXmlTag
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
        $values = (string) $element;
        $child = $element->addChild('setData');
        $child->addAttribute('values', $values);
        $this->setData($child);
    }

    /**
     * Sets the data.
     * Data are in a comma-separated string
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setData(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the attribute
        $values = (string) $element->attributes()->values;
        if ($values == '') {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'values',
                $elementName
            ]);
        }

        // Checks if the values are a reference
        if (XmlParser::isReference($values)) {
            $this->xmlTagValue = XmlParser::getValueFromReference($values);
        } else {
            $values = XmlParser::replaceSpecialChars($values);
            $this->xmlTagValue = GeneralUtility::trimExplode(',', $values);
            foreach ($this->xmlTagValue as $key => $value) {
                if (is_numeric($value)) {
                    $this->xmlTagValue[$key] = $value + 0;
                }
            }
        }
    }

    /**
     * Sets an item in the data.
     * Data are in a comma-separated string
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function item(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the key
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

        // Checks if there is a values attribute.
        // It is assumed that it is a comma-separated list
        $commaSeparatedValue = (string) $element->attributes()->values;
        if (! empty($commaSeparatedValue)) {
            $commaSeparatedValue = XmlParser::replaceSpecialChars($commaSeparatedValue);
            $values = GeneralUtility::trimExplode(',', $commaSeparatedValue);
            $this->xmlTagValue[$key] = [];
            foreach ($values as $valueKey => $value) {
                if (is_numeric($value)) {
                    $this->xmlTagValue[$key][$valueKey] = $value + 0;
                }
            }
            return;
        }

        // Checks if there is a value
        $value = (string) $element->attributes()->value;

        if (empty($value)) {
            if (! count($element->children())) {
                // No children found, returns the element
                $this->xmlTagValue[$key] = XmlParser::replaceSpecialChars((string) $element);
            } else {
                $this->xmlTagValue[$key] = $this->xmlParser->processSubItemElement($element);
            }
        } else {
            if (XmlParser::isReference($value) !== false) {
                $value = XmlParser::getValueFromReference($value);
            }
            if ($value === 'true') {
                $this->xmlTagValue[$key] = true;
            } elseif ($value === 'false') {
                $this->xmlTagValue[$key] = false;
            } else {
                $this->xmlTagValue[$key] = $value;
            }
        }
    }

    /**
     * Sets the data from a query
     * Data are in an array
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setDataFromQuery(\SimpleXMLElement $element)
    {
        // Checks if the queries are allowed
        $settings = XmlParser::getController()->getSettings();
        if (empty($settings['flexform']['allowQueries'])) {
            return XmlParser::getController()->addError('error.queriesMustBeAllowed', [
                'SetDataFromQuery'
            ]);
        }

        // Gets the element name
        $elementName = (string) $element->getName();

        // Checks if there is a query id
        $query = (string) $element->attributes()->query;
        if (empty($query)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'query',
                $elementName
            ]);
        }
        if (XmlParser::isReference($query) !== false) {
            $query = XmlParser::getValueFromReference($query);
        }

        // Sets query reference
        $queryReference = 'query#' . $query;
        if (! is_scalar($query) || XmlParser::isReference($queryReference) === false) {
            return XmlParser::getController()->addError('error.incorrectReferenceValue', [
                'query',
                $query
            ]);
        }

        // Checks if there is a field attribute
        $field = (string) $element->attributes()->field;
        if (empty($field)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'field',
                $elementName
            ]);
        }

        // Checks if there is a groupby attribute
        $groupby = (string) $element->attributes()->groupby;
        if (! empty($groupby)) {
            if (XmlParser::isReference($groupby) !== false) {
                $groupby = count(XmlParser::getValueFromReference($groupby));
            }
        }

        // Gets the query result
        $xmlTagValue = XmlParser::getValueFromReference($queryReference);
        $counter = 0;
        foreach ($xmlTagValue as $key => $values) {
            $value = $values[$field];
            if (is_numeric($value)) {
                $value = $value + 0;
            }
            if ($groupby != 0) {
                $this->xmlTagValue[$counter / $groupby][$counter % $groupby] = $value;
                $counter ++;
            } else {
                $this->xmlTagValue[$key] = $value;
            }
        }
    }

    /**
     * Sets the data from a query row
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function setDataFromQueryRow(\SimpleXMLElement $element)
    {
        // Checks if the queries are allowed
        $settings = XmlParser::getController()->getSettings();
        if (empty($settings['flexform']['allowQueries'])) {
            return XmlParser::getController()->addError('error.queriesMustBeAllowed', [
                'SetDataFromQuery'
            ]);
        }

        // Gets the element name
        $elementName = (string) $element->getName();

        // Checks if there is a query id
        $query = (string) $element->attributes()->query;
        if (empty($query)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'query',
                $elementName
            ]);
        }
        if (XmlParser::isReference($query) !== false) {
            $query = XmlParser::getValueFromReference($query);
        }

        // Sets query reference
        $queryReference = 'query#' . $query;
        if (! is_scalar($query) || XmlParser::isReference($queryReference) === false) {
            return XmlParser::getController()->addError('error.incorrectReferenceValue', [
                'query',
                $query
            ]);
        }

        // Checks if there is a fields attribute
        $fields = (string) $element->attributes()->fields;
        if (empty($fields)) {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'fields',
                $elementName
            ]);
        }

        // Gets the query result
        $fieldsArray = explode(',', $fields);
        $counter = 0;
        $xmlTagValue = XmlParser::getValueFromReference($queryReference);
        foreach ($fieldsArray as $field) {
            if (isset($xmlTagValue[0][trim($field)])) {
                $value = $xmlTagValue[0][trim($field)];
                if (is_numeric($value)) {
                    $value = $value + 0;
                }
                $this->xmlTagValue[$counter ++] = $value;
            }
        }
    }

    /**
     * Reorganizes the data by index.
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function reorganizeByIndex(\SimpleXMLElement $element)
    {
        // Checks if there is a key
        $mainKey = (string) $element->attributes()->key;
        if (XmlParser::isReference($mainKey) !== false) {
            $mainKey = XmlParser::getValueFromReference($mainKey);
        }

        $xmlTagValue = $this->xmlTagValue;
        unset($this->xmlTagValue);
        foreach ($xmlTagValue as $key => $values) {
            foreach ($values as $index => $value) {
                if (! empty($mainKey)) {
                    if (isset($xmlTagValue[$mainKey][$index])) {
                        $this->xmlTagValue[$index][$key] = $value;
                    } else {
                        continue;
                    }
                } else {
                    $this->xmlTagValue[$index][$key] = $value;
                }
            }
        }
    }

    /**
     * Changes the data to percentage
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function changeToPercentage(\SimpleXMLElement $element)
    {
        // Gets the precision
        $precision = (string) $element->attributes()->precision;
        if (empty($precision)) {
            $precision = 1;
        }
        if (XmlParser::isReference($precision) !== false) {
            $precision = XmlParser::getValueFromReference($precision);
        }

        // Computes the sum
        $sum = [];
        foreach ($this->xmlTagValue as $dataKey => $data) {
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $sum[$dataKey] += $value;
                }
            } else {
                $sum[0] += $data;
            }
        }

        foreach ($this->xmlTagValue as $dataKey => $data) {
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $this->xmlTagValue[$dataKey][$key] = round(100 * $this->xmlTagValue[$dataKey][$key] / $sum[$dataKey], $precision);
                }
            } else {
                $this->xmlTagValue[$dataKey] = round(100 * $this->xmlTagValue[$dataKey] / $sum[0], $precision);
            }
        }
    }

    /**
     * Processes callback
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function callback(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the key
        $key = (string) $element->attributes()->key;
        if ($key == '') {
            return XmlParser::getController()->addError('error.missingAttribute', [
                'key',
                $elementName
            ]);
        }

        // Creates a DOM document to get the comment
        $document = new \DOMDocument();
        $document->loadXML($element->asXML());
        $xpath = new \DOMXPath($document);
        $text = $xpath->query('/callback/comment()')->item(0)->textContent;

        if (empty($text)) {
            $text = '###' . trim((string) $element) . '###';
        }

        $this->xmlTagValue[$key] = '<!--' . $text . '-->';
    }
}
?>
