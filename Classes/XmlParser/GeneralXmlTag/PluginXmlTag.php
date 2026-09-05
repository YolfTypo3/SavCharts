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
 * Class template
 *
 * This class is used to define <plugin> </plugin> in xml code
 */
class PluginXmlTag extends AbstractXmlTag
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

        // Gets the chart ID
        $chartId = (string) $element->attributes()->chartId;
        if ($chartId == '') {
            XmlParser::addError('error.missingAttribute', [
                'fileName',
                $elementName
            ]);
            return;
        }
        
        // Gets the key
        $key = (string) $element->attributes()->key;
        if ($key == '') {
            XmlParser::addError('error.missingAttribute', [
                'fileName',
                $elementName
            ]);
            return;
        }
        
        // Gets the file name
        $fileName = (string) $element->attributes()->fileName;
        if ($fileName == '') {
            XmlParser::addError('error.missingAttribute', [
                'fileName',
                $elementName
            ]);
            return;
        } else {
            $absFileName = GeneralUtility::getFileAbsFileName($fileName);
            if (! file_exists($absFileName)) {
                XmlParser::addError('error.unknownFile', [
                    $fileName
                ]);
                return;
            }
        }
          
        $this->xmlTagValue[$chartId] = ['key' => $key, 'fileName' => $fileName];
    }
  
}
