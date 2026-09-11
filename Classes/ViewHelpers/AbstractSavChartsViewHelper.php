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

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Abstract SavChars ViewHelper.
 *
 * @package SavCharts
 */
abstract class AbstractSavChartsViewHelper extends AbstractViewHelper
{    
    
    protected array $debugValues = [
        'charts'    => 0b00000001,
        'marker'    => 0b00000010,
        'query'     => 0b00000100,
        'data'      => 0b00001000,
        'item'      => 0b00010000,
        'callback'  => 0b00100000,
    ];
    
    /**
     * Gets value by a reference:
     * - marker__id
     * - data__id
     *
     * @param mixed $value
     * 
     * @return mixed
     */
    public function getByReference(mixed $value): mixed
    {
        $matches = [];
        if (is_string($value) && preg_match('/^((?:marker__|data__)(?:[^\.]+))(?:\.(\d+))?$/', $value, $matches)) {
            $variableProvider = $this->renderingContext->getVariableProvider();
            if ($variableProvider->exists($matches[1])) {
                $value = $variableProvider->get($matches[1]);
                if (isset($matches[2]) && is_array($value)) {
                    $value = $value[$matches[2]];
                }
            } else {
                throw new \InvalidArgumentException(
                    'Reference "' . $value . '" does not exist.'
                    );
            }
        }
        
        return $value;
    }

    /**
     * Merges in variable provider.
     * 
     * @param string $identifier 
     * @param mixed $key
     * @param string $value
     *
     * @return void
     */
    protected function mergeInVariableProvider(string $identifier, mixed $key, mixed $value): void 
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        $items = array_merge_recursive(($variableProvider->get($identifier)??[]), [strval($key) => $value]);
        $variableProvider->add($identifier, $items);
    }

    /**
     * Transposes data.
     *
     * @param array $data
     *
     * @return array
     */
    protected function transposeData(array $data): array
    {
        $result = [];
        foreach (array_keys($data[0]) as $key) {
            $result[$key] = array_column($data, $key);
        }
      
        return $result;
    }
    
    /**
     * Debugs in.
     *
     * @param string $tag
     * @param mixed $id
     *
     * @return void
     */
    protected function debugIn(string $tag, mixed $id): void
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        $contentUid = $variableProvider->get('contentUid');
        $debug = $variableProvider->get('debug');
        $debugValue = $this->debugValues[$tag] ?? 0;
        
        if ($debug & $debugValue) {
            debug('--> [' . $contentUid . '] ' . $tag . ': ' . strval($id));
        }
    }
        
    /**
     * Debugs out.
     *
     * @param string $tag
     * @param mixed $id
     *
     * @return void
     */
    protected function debugOut(string $tag, mixed $id): void
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        $contentUid = $variableProvider->get('contentUid');
        $debug = $variableProvider->get('debug');
        $debugValue = $this->debugValues[$tag] ?? 0;
        
        if ($debug & $debugValue) {
            $result = [];
            $variables = $variableProvider->getAll();
            foreach ($variables as $keyVariable => $variable) {
                if (strpos($keyVariable, $tag . '__') !== false) {
                    $result[$keyVariable] = $variable;
                }
            }

            debug($result, '<-- [' . $contentUid . '] ' . $tag . ': ' . strval($id));
        }
    }
    
}
