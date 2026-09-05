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
 * A view helper for the marker tag.
 *
 *
 * @package SavCharts
 */
final class MarkerViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Marker ID', true);
        $this->registerArgument('value', 'string', 'Marker value', false, '');
        $this->registerArgument('reload', 'boolean', 'If true, the marker is reloaded if it exists', false, false);
    }

    /**
     * Renders the view helper
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments.
        $id = $this->arguments['id'];
        $value = $this->arguments['value'];
        $reload = $this->arguments['reload'];
        
        // Gets the variable provider from the rendering context.
        $variableProvider = $this->renderingContext->getVariableProvider();
        
        // Debugs in
        $this->debugIn('marker', $id); 
        
        // Checks if the marker exists.
        if (!$reload && $variableProvider->exists('marker__' . $id)) {
            $viewHelperVariableValue = $variableProvider->get('marker__' . $id);
        } else {
            // Checks if they are children.
            if (empty($value)) {
                $viewHelperVariableValue = $this->renderChildren();
            } else {
                // Gets the value directly or by reference.
                $viewHelperVariableValue = $this->getByReference($value);    
            }
        }
        
        $variableProvider->add('marker__' . $id, $viewHelperVariableValue);        

        // Debugs out
        $this->debugOut('marker', $id); 
    }
}
