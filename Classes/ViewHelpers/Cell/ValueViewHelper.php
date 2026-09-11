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
 * A viewHelper to get the value of a cell.
 *
 * @package SavCharts
 */
final class ValueViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('address', 'string', 'Address of the cell', true);
        
    }

    /**
     * Renders the viewHelper.
     *
     * @return mixed
     */
    public function render(): mixed
    {
        
        // Gets the arguments.
        $address = $this->arguments['address'];
        
        // Gets the worksheet.
        $variableProvider = $this->renderingContext->getVariableProvider();
        $worksheet = $variableProvider->get('worksheet__');
        
        if ($worksheet !== null)  {
            // Gets the cell and return its value.
            $cell = $worksheet->getCell($address);
            return $cell->getValue();
        } else {
            $message = sprintf(
                'The viewHelper <c:cell.value> must be called in inside <c:worksheet>.'
                );
            throw new \InvalidArgumentException($message);
        }  
    }
}

