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
 * A viewHelper for a worksheet.
 *
 * @package SavCharts
 */
final class WorkSheetViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('name', 'string', 'Worksheet name', true);
    }

    /**
     * Renders the viewHelper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments.       
        $name = $this->arguments['name'];
        
        // Gets the spreadsheet.
        $variableProvider = $this->renderingContext->getVariableProvider();        
        $spreadsheet = $variableProvider->get('spreadsheet__');
        
        if ($spreadsheet !== null)  {
            // Gets the worksheet and saves it in the variable provider.
            $worksheet = $spreadsheet->getSheetByNameOrThrow($name);
            $variableProvider->add('worksheet__', $worksheet);

            // Renders the children and removes the worksheet from the variable provider.
            $this->renderChildren();
            $variableProvider->remove('worksheet__');
        } else {
            $message = sprintf(
                'Worksheet viewHelper must be used in inside <c:spreadsheet>.',
                $fileName
                );
            throw new \InvalidArgumentException($message);
        }  
        
    }
}

