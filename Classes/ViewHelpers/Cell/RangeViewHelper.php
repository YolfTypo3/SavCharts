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

namespace YolfTypo3\SavCharts\ViewHelpers\Cell;

use YolfTypo3\SavCharts\ViewHelpers\AbstractSavChartsViewHelper;

/**
 * A viewHelper to a range of cells.
 *
 * @package SavCharts
 */
final class RangeViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('range', 'string', 'Range of cells', true);
        $this->registerArgument('nullValue', 'mixed', 'Value returned in the array entry if a cell doesn\'t exist', false, null);
        $this->registerArgument('calculateFormulas', 'boolean', 'If true, formulas are calculated', false, true);
        $this->registerArgument('formatData', 'boolean', 'If true, formatting is applied to the cell values', false, false);
        $this->registerArgument('returnCellRef', 'boolean', 'If false, it returns a simple array of rows and columns indexed by number counting from zero. If true, row and column IDs are kept', false, false);
        $this->registerArgument('ignoreHidden', 'boolean', 'If false, values for rows/columns are returned even if they are defined as hidden', false, false);
        $this->registerArgument('search', 'mixed', 'If formatData is true, it provides search string or array', false, null);        
        $this->registerArgument('replace', 'mixed', 'If formatData is true, it provides replacement string or array', false, null);
    }

    /**
     * Renders the viewHelper.
     *
     * @return mixed
     */
    public function render(): mixed
    {       
        // Gets the arguments.
        $range = $this->arguments['range'];
        $nullValue = $this->arguments['nullValue'];
        $calculateFormulas = $this->arguments['calculateFormulas'];
        $formatData = $this->arguments['formatData'];
        $returnCellRef = $this->arguments['returnCellRef'];
        $ignoreHidden = $this->arguments['ignoreHidden'];
        $search = $this->arguments['search'];
        $replace = $this->arguments['replace'];
                
        // Gets the worksheet.
        $variableProvider = $this->renderingContext->getVariableProvider();
        $worksheet = $variableProvider->get('worksheet__');
        
        if ($worksheet !== null)  {
            
            // Gets the cells and return its value.
            $dataArray = $worksheet->rangeToArray(
                    $range,             // The worksheet range that we want to retrieve
                    $nullValue,         // Value that should be returned for empty cells
                    $calculateFormulas, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                    $formatData,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                    $returnCellRef,     // Should the array be indexed by cell row and cell column
                    $ignoreHidden       // Should the hidden value be ignored 
                    ); 
            if ($formatData && $search !== null && $replace !== null) {
                foreach($dataArray as $rowKey => $rowValue) {
                    foreach($rowValue as $columnKey => $columnValue) {
                        $dataArray[$rowKey][$columnKey] = str_replace($search, $replace, $columnValue);
                    }
                }
            }

            return $dataArray;
        } else {
            $message = sprintf(
                'The viewHelper <c:cell.range> must be called in inside <c:worksheet>.'
                );
            throw new \InvalidArgumentException($message);
        }  
    }
}

