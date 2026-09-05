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
 * A view helper for the item tag.
 *
 *
 * @package SavCharts
 */
final class ItemViewHelper extends AbstractSavChartsViewHelper
{
    /**
     * Stack
     * 
     * @var array
     */
    protected static $stack = [];
    
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('key', 'string', 'Item key', true);
        $this->registerArgument('value', 'mixed', 'Item value', false, null);    
        $this->registerArgument('values', 'string', 'Item comma-separated values', false, null);        
    }

    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments.
        $key = $this->arguments['key'];
        $value = $this->arguments['value'];
        $values = $this->arguments['values'];
                
        // Debugs in.
        $this->debugIn('item', $key);
        
        // Pushes the key.
        self::push($key);
        
        // Checks if they are children.
        $variableProvider = $this->renderingContext->getVariableProvider();       
        if (is_null($value) && is_null($values)) {
            $childrenValue = $this->renderChildren();
            if ($childrenValue === null) {
                throw new \InvalidArgumentException(
                    'Argument "value" is null in <c:item key="' . $key . '" value="" />.'
                    );
            }
            if (is_string($childrenValue)) {
                $childrenValue = trim($childrenValue);
            }           
            if (empty($childrenValue)) { 
                if ($variableProvider->exists('callback__')) {
                    $viewHelperVariableValue = $variableProvider->get('callback__') ?? [];
                    $variableProvider->remove('callback__');
                } 
            } else {
                $viewHelperVariableValue = $childrenValue;
            }
        } else {           
            if (!is_null($value)) {
                // Gets the value directly or by reference.
                $viewHelperVariableValue = $this->getByReference($value);
                if ($viewHelperVariableValue === 'true') {
                    $viewHelperVariableValue = true;
                } elseif ($viewHelperVariableValue === 'false') {
                    $viewHelperVariableValue = false;
                }
            } elseif (!is_null($values)) {
                // Gets a comma-separated list of values.
                $values = GeneralUtility::trimExplode(',', $values);
                foreach ($values as $keyValue => $value) {
                    if (is_numeric($value)) {
                        $values[$keyValue] = $value + 0;
                    }
                }
                $viewHelperVariableValue = $values;
            }
        }

        self::pop();
        // Checks if there are any keys left in the stack.
        if(self::stackEmpty()) {
                // Merges the ViewHelper value if it exists.
            if (isset($viewHelperVariableValue)) {
                $this->mergeInVariableProvider('item__', $key, $viewHelperVariableValue);
            }
        } else {
            // Gets the parent key.
            $parentKey = self::getParent();
            
            // Gets the already known items.
            $items = $variableProvider->get('item__') ?? [];

            // Checks if the key already exixts in items.
            if (array_key_exists($key, $items)) {
                // Gets the children values
                $values = [strval($key) => $items[$key]];
                // Removes the children values in items and merges.
                unset($items[$key]);
                $items = array_merge_recursive($items, [strval($parentKey) => $values]);
                $variableProvider->add('item__', $items);
            } else {
                if (isset($viewHelperVariableValue)){
                    // Gets the children values and merges.
                    $items[$parentKey][$key] = $viewHelperVariableValue;
                    $variableProvider->add('item__', $items);
                } 
            }
        }
               
        // Debugs out.
        $this->debugOut('item', $key);        
    }
    

    /**
     * Helper methods
     * 
     */             
    protected static function push($key) {
        array_push(self::$stack, $key);
    }
 
    protected static function pop() {
        return array_pop(self::$stack) ?? null;
    }
    
    protected static function stackEmpty() {
        return empty(self::$stack);
    }
    
    protected static function getParent() {
        return end(self::$stack);
    }

}
