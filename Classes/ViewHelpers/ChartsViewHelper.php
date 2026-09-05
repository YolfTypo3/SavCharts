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

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use YolfTypo3\SavCharts\Controller\DefaultController;

/**
 * A view helper for charts.
 *
 *
 * @package SavLibraryKickstarter
 */
final class ChartsViewHelper extends AbstractSavChartsViewHelper
{
         
    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render(): void
    {       
        $this->renderChildren();
        
        // Processes the charts.
        $javaScriptFooterInlineCode = [];
        $variableProvider = $this->renderingContext->getVariableProvider();
        $charts = $variableProvider->get('charts__');
        foreach ($charts as $chart) {
            // Sets the chart id.
            $chartId = bin2hex(random_bytes(8));
        
            // Creates the JavaScript for data. 
            $data = $chart['data'];
            $data = json_encode($chart['data']);
            
            // Creates the JavaScript for options.
            if (empty($chart['options'])) {
                $options = '{}';
            } else {
                // Processes strings converted into objects (callbacks).
                $options = json_encode($chart['options'], JSON_NUMERIC_CHECK);
                $options = preg_replace(['/\\\n/', '/\\\r/', '/\\\t/', '/{"scalar":"(.*?)"}/s'], [chr(10), '', '    ', '$1'], $options);
            }
            
            // Creates the JavaScript for plugins.
            $plugins = '[]';
            if (!empty($chart['plugins']) && is_array($chart['plugins'])) {
                $javaScriptFooterInlineCode[] = 'const plugin' . $chartId . ' = [';
                $lastKey = array_key_last($chart['plugins']);
                foreach ($chart['plugins'] as $pluginKey => $plugin) {
                    $javaScriptFooterInlineCode[] = '{';
                    $javaScriptFooterInlineCode[] = 'id: \'' . $pluginKey . '\',' ;
                    $plugin = json_encode($plugin, JSON_NUMERIC_CHECK);
                    $plugin = preg_replace(['/\\\n/', '/\\\r/', '/\\\t/', '/{"scalar":"(.*?)"}/s'], [chr(10), '', '    ', '$1'], $plugin);
                    $javaScriptFooterInlineCode[] = $plugin;
                    $javaScriptFooterInlineCode[] = $pluginKey == $lastKey ? '}' : '},';
                }
                $javaScriptFooterInlineCode[] = '];';
                $plugins = 'plugin' . $chartId . '';
            }
                       
            $javaScriptFooterInlineCode[] = 'const canvas' . $chartId . ' = document.getElementById(\'canvas' . $chartId . '\').getContext(\'2d\');';
            $javaScriptFooterInlineCode[] = 'const chart' . $chartId . ' = new Chart(canvas' . $chartId . ', {type:\'' . $chart['type'] . '\', plugins: ' . $plugins . ', data:' . $data . ', options:' . $options . '});';      
            $canvases[] = [
                'chartId' => $chartId,
                'width' => $chart['width'],
                'height' => $chart['height'], 
            ];

            // Creates the page renderer.
            /** @var PageRenderer $pageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

            // Adds the canvas JavaScript.
            foreach ($canvases as $canvas) {
                $pageRenderer->addJsFooterInlineCode($canvas['chartId'], implode(chr(10), $javaScriptFooterInlineCode));
            }
                    
            // Add the latest Chart.js file.
            $javaScriptRootDirectory = ExtensionManagementUtility::extPath('sav_charts') . DefaultController::$javaScriptRootPath;
            $javaScriptFiles = scandir($javaScriptRootDirectory, SCANDIR_SORT_DESCENDING);
            $javaScriptFooterFile = 'EXT:sav_charts/' . DefaultController::$javaScriptRootPath . '/' . $javaScriptFiles[0];
                    
            $pageRenderer->addJsFooterFile($javaScriptFooterFile);
                    
            // Add the css file.
            $cssFile = 'EXT:sav_charts/' . DefaultController::$cssPath;
            $pageRenderer->addCssFile($cssFile);
                    
            // Add the canvases to the variable.
            $variableProvider->add('canvases', $canvases);                   
        }
    }
}
