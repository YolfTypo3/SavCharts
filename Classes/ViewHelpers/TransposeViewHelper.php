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
 
/**
 * A view helper for transposing data.
 *
 *
 * @package SavCharts
 */
final class TransposeViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('data', 'array', 'Data to transpose', true);
    }

    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render(): array
    {
        // Gets the arguments
        $data = $this->arguments['data'];    
        if (empty($data)) {
            $data = $this->renderChildren();
        }   
        $result = $this->transposeData($data);

        return $result;
    }
    
}
