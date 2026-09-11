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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A viewHelper for a spreadsheet.
 *
 * @package SavCharts
 */
final class SpreadSheetViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('fileName', 'string', 'Spreadsheet file name', true);
    }

    /**
     * Renders the viewHelper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments        
        $fileName = $this->arguments['fileName'];
        
        $absFileName = GeneralUtility::getFileAbsFileName(trim($fileName));
        if ($absFileName !== null && file_exists($absFileName)) {
            
            // Checks if spreadsheet viewHelper can be used.            
            if (!class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
                $message = sprintf(
                    'PhpSpreadsheet has to be installed to use <c:spreadsheet>.'
                    );
                throw new \InvalidArgumentException($message);
                
            }
            // Creates a new Reader of the identified type.       
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($absFileName);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            
            // Loads the spreadsheet
            $spreadsheet = $reader->load($absFileName);

            // Saves the spreadsheet in the variable provider.
            $variableProvider = $this->renderingContext->getVariableProvider();            
            $variableProvider->add('spreadsheet__', $spreadsheet);
            
            // Renders the children and removes the spreadsheet from the variable provider.
            $this->renderChildren();  
            $variableProvider->remove('spreadsheet__');
        } else {
            $message = sprintf(
                'Spreadsheet "%s" does not exist.',
                $fileName
                );
            throw new \InvalidArgumentException($message);
        }  
    }
}
