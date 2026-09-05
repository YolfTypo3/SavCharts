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
 * A view helper for the data tag.
 *
 *
 * @package SavCharts
 */
final class DataViewHelper extends AbstractSavChartsViewHelper
{
    
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Data id', true);
        $this->registerArgument('values', 'mixed', 'Data or comma-separated values if the child is a string)', false, '');
    }

    /**
     * Renders the view helper
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments
        $id = $this->arguments['id'];
        $values = $this->arguments['values'];
               
        // Gets the variable provider from the rendering context.
        $variableProvider = $this->renderingContext->getVariableProvider();

        // Debugs in
        $this->debugIn('data', $id);  
        
        // Checks if data exist.
        if ($variableProvider->exists('data__' . $id) ) {
            $viewHelperVariableValue = $variableProvider->get('data__' . $id);
        } else {
            // Checks if they are children.
            if (empty($values)) {
                // Gets the children.
                $childrenValue = $this->renderChildren();
                if (is_string($childrenValue)) {
                    $childrenValue = trim($childrenValue);
                }                
                if (empty($childrenValue)) {
                    // Checks if items where associated to the data tag.
                    if ($variableProvider->exists('item__')) {
                        $values = $variableProvider->get('item__');
                        $variableProvider->remove('item__');
                    } else {
                      $values = [];
                    }
                } else {
                    if (is_string($childrenValue)) {
                        // Comma-separated list of values
                        $values = GeneralUtility::trimExplode(',', $childrenValue);
                        foreach ($values as $keyValue => $value) {
                            if (is_numeric($value)) {
                                $values[$keyValue] = $value + 0;
                            }
                        }
                    } else {
                        $values = $childrenValue;
                    }
                }
                $viewHelperVariableValue = $values;
            } else {               
                // Gets the value directly or by reference.
                $viewHelperVariableValue = $this->getByReference($values);
            }
        }
        
        $variableProvider->add('data__' . $id, $viewHelperVariableValue);

        // Debugs out.
        $this->debugOut('data', $id);           
    }
}