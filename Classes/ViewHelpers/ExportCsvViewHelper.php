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

namespace YolfTypo3\SavCharts\ViewHelpers;
 
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\CsvUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 * A view helper for the exporting data in CSV.
 *
 *
 * @package SavCharts
 */
final class ExportCsvViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('fileName', 'string', 'File name to save the CSV in typo3temp/sav_charts', true);
        $this->registerArgument('columnHeader', 'array', 'Column header', false);
        $this->registerArgument('rowHeader', 'array', 'Row header', false);
        $this->registerArgument('data', 'mixed', 'Data to export', true);
    }

    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments
        $fileName = $this->arguments['fileName'];
        $columnHeader = $this->arguments['columnHeader'];
        $rowHeader = $this->arguments['rowHeader'];
        $data = $this->arguments['data'];
                
        $output = [];

        if (!empty($columnHeader)) {
            if (!empty($rowHeader)) {
                $columnHeader = array_merge([''], $columnHeader);
            }
            $output[] = CsvUtility::csvValues($columnHeader, ';');
        }

        foreach($data as $key => $value) {
            if (!empty($rowHeader)) {
                if (!is_scalar($rowHeader[$key] ?? null)) {
                    $message = sprintf(
                        'Key ""%s" in rowHeader does not exist or is not a scalar.',
                        $key
                        );
                    throw new \InvalidArgumentException($message);
                    
                }
                $value = array_merge([$rowHeader[$key]], $value);
            }
            $output[] = CsvUtility::csvValues($value, ';');
        }
             
        // Writes values in CSV file.
        $content = implode(chr(10), $output);
        $message = GeneralUtility::writeFileToTypo3tempDir(
            Environment::getPublicPath() . '/typo3temp/sav_charts/' . $fileName, 
            $content
            );
        if (!is_null($message)) {
            throw new \InvalidArgumentException($message);
        }
    }
    
}
