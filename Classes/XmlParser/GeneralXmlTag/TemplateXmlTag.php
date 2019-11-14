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
 * Class template
 *
 * This class is used to define <template> </template> in xml code
 */
class TemplateXmlTag extends AbstractXmlTag
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
        $fileName = trim((string) $element);
        $child = $element->addChild('loadTemplate');
        $child->addAttribute('fileName', $fileName);
        $this->loadTemplate($child);
    }

    /**
     * Loads and processes an xml template
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function loadTemplate(\SimpleXMLElement $element)
    {
        // Gets the element name
        $elementName = (string) $element->getName();

        // Gets the attribute
        $fileName = (string) $element->attributes()->fileName;
        if ($fileName == '') {
            return  XmlParser::getController()->addError(
                'error.missingAttribute',
                [
                    'fileName',
                    $elementName
                ]
            );
        }
        if (XmlParser::isReference($fileName) !== false) {
            $fileName = XmlParser::getValueFromReference($fileName);
        }

        // loads and processes the file
        $this->xmlParser->loadXmlFile($fileName);
        $this->xmlParser->parseXml();
    }
}
?>
