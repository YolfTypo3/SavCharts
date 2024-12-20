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
 * Class marker
 *
 * This class is used to define <marker> </marker> in xml code
 */
class ForXmlTag extends AbstractXmlTag
{

    /**
     * Default method
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function defaultMethod(\SimpleXMLElement $element): void
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the each attribute
        $each = (string) $element->attributes()->each;
        if ($each == '') {
            XmlParser::getController()->addError('error.missingAttribute', [
                'each',
                $elementName
            ]);
            return;
        }

        // Checks if the each attribute is a reference
        // otherwise processes it as a comma-separated lis
        if (XmlParser::isReference($each)) {
            $eachValue = XmlParser::getValueFromReference($each);
        } else {
            $eachValue = GeneralUtility::trimExplode(',', $each);
        }

        foreach ($eachValue as $key => $value) {
            $this->xmlTagValue['key'] = $key;
            $this->xmlTagValue['value'] = $value;
            XmlParser::setXmlTagResult($elementName, $this->xmlTagId, $this);
            foreach ($element->children() as $child) {
                $this->xmlParser->processXmlElement($child);
            }
        }
    }
}
