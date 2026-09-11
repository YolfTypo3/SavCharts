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
 * A viewHelper to get the font color of a cell.
 *
 * @package SavCharts
 */
final class ColorViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('address', 'string', 'Address of the cell', true);
        $this->registerArgument('alpha', 'int', 'If set, it modifies the transparency', false, 100);
    }

    /**
     * Renders the viewHelper.
     *
     * @return string
     */
    public function render(): string
    {        
        // Gets the arguments.
        $address = $this->arguments['address'];
        $alpha = $this->arguments['alpha'];
        
        // Checks the range of the alpha parameter.
        if ($alpha < 0 || $alpha > 100) {
            $message = sprintf(
                'Alpha parameter must be in [0, 100], "%d" given.',
                $alpha
                );
            throw new \InvalidArgumentException($message);
        }
        
        // Gets the worksheet.
        $variableProvider = $this->renderingContext->getVariableProvider();
        $worksheet = $variableProvider->get('worksheet__');
        
        if ($worksheet !== null)  {
            // Gets the cell and return its value.
            $cell = $worksheet->getCell($address);
            $font = $cell->getStyle()->getFont();
            $fontColor = $font->getColor()->getARGB();
            return '#' . substr($fontColor, 2, 6) . dechex((int) (hexdec(substr($fontColor, 0, 2))*$alpha/100));
        } else {
            $message = sprintf(
                'The viewHelper <c:cell.color> must be called in inside <c:worksheet>.'
                );
            throw new \InvalidArgumentException($message);
        }  
    }
}

