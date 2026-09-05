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
 * Abstract chart ViewHelper.
 *
 *
 * @package SavCharts
 */
abstract class AbstractChartViewHelper extends AbstractSavChartsViewHelper
{
    protected $configuration;
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Chart ID', true);
        $this->registerArgument('data', 'string', 'Data, or a reference to data', true);
        $this->registerArgument('options', 'string', 'Options, or a reference to options', false, '');
        $this->registerArgument('width', 'string', 'Width value, or a reference to the width value', false, '600');
        $this->registerArgument('height', 'string', 'Height value, or a reference to the height value', false, '400');
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
        $data = $this->arguments['data'];
        $options = $this->arguments['options'];
        $width = $this->arguments['width'];
        $height = $this->arguments['height'];
    
        // Debugs in.
        $this->debugIn('charts', $id); 
        
        // Renders the children.
        $this->renderChildren();

        $viewHelperVariableValue = [
            'type' => $this->configuration['type'],
            'data' => $this->getByReference($data),
            'options' => array_merge($this->configuration['options'], $this->getByReference($options)),
            'width' => $this->getByReference($width),
            'height' => $this->getByReference($height)
            ];

        $shortClassName = lcfirst(str_replace('ViewHelper', '', basename(get_class($this))));
        $this->mergeInVariableProvider('charts__', $shortClassName . '__' . $id, $viewHelperVariableValue);        
        
        // Debugs out.
        $this->debugOut('charts', $id); 
    }   
}
