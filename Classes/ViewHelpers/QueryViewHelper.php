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
 * A view helper for the query tag.
 *
 *
 * @package SavCharts
 */
final class QueryViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Query id', true);
        $this->registerArgument('manager', 'string', 'Query manager', false);
        $this->registerArgument('uid', 'string', 'UID of the query record', false);
    }

    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments
        $id = $this->arguments['id'];
        $manager = $this->arguments['manager'];
        $uid = $this->arguments['uid'];

        // Gets the variable provider from the rendering context.
        $variableProvider = $this->renderingContext->getVariableProvider();

        // Debugs in.
        $this->debugIn('query', $id);  
        
        if (!empty($manager) && !empty($uid)) {
            // Processes the query.
            $markers = $this->getQueryMarkers();
            $rows = $this->processQuery($manager, $uid, $markers);
        
            // Transposes the row.
            $result = $this->transposeData($rows);
            
            // Adds the result to the variable provider.
            $variableProvider->add('query__' . $id, $result);           
        }
        
        // Debugs out.
        $this->debugOut('query', $id); 
    }

    /**
     * Get the query markers.
     *
     * @return array
     */
    public function getQueryMarkers(): array
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        $variables = $variableProvider->getAll() ?? [];
        $result = [];
        foreach ($variables as $keyVariable => $variable) { 
            if (strpos($keyVariable, 'marker__') !== false) {
                $key = str_replace('marker__', '', $keyVariable);
                $result[$key] = $variable;
            } 
        }      
        return $result;        
    }
      
    /**
     * Processes the query.
     *
     * @param string $queryManagerName
     * @param mixed $uid
     * @param array $markers
     *
     * @return array|false
     */
    public function processQuery(string $queryManagerName, mixed $uid, array $markers): array|false
    {
        // Gets the class from the hook.
        $hookFound = false;
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass'])) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass'] as $key => $classRef) {
                if ($key == $queryManagerName) {
                    $hookObject = GeneralUtility::makeInstance($classRef);
                    $hookFound = true;
                }
            }
        }
        
        if ($hookFound === false) {
            $message = sprintf(
                'Query manager "%s" does not exist.',
                $queryManagerName
                );
            throw new \InvalidArgumentException($message);
        }

        // Injects the markers.
        $hookObject->injectMarkers($markers);
        
        // Executes the query.
        $rows = $hookObject->executeQuery(intval($uid));
        
        return $rows;
    }
}
