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
 * A viewHelper for Charts.js.
 *
 * @package SavLibraryKickstarter
 */
final class PlotlyChartsViewHelper extends AbstractSavChartsViewHelper
{
         
    /**
     * Renders the viewHelper.
     *
     * @return void
     */
    public function render(): void
    {       
        $this->renderChildren();

        // Creates the page renderer.
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        
        // Processes the charts.
        $javaScriptFooterInlineCode = [];
        $variableProvider = $this->renderingContext->getVariableProvider();
        $charts = $variableProvider->get('charts__');
        $generatedCharts = [];
        
        foreach ($charts as $chartKey => $chart) {
            // Sets the chart id with the contentUID, if it exists, randomly otherwise.
            if ($variableProvider->exists('contentUid')) {
                $contentUid = $variableProvider->get('contentUid');
                $chartId = $contentUid . '_' . $chartKey;
            } else {    
                $chartId = bin2hex(random_bytes(8));
            }
        
            // Creates the JavaScript for data. 
            $data = $chart['data'];
            $data = json_encode($chart['data']);
            
            // Creates the JavaScript for layout.
            if (empty($chart['layout'])) {
                $layout = '{}';
            } else {
                // Processes strings converted into objects (callbacks).
                $layout = json_encode($chart['layout'], JSON_NUMERIC_CHECK|JSON_UNESCAPED_SLASHES);
                $layout = preg_replace(['/\\\n/', '/\\\r/', '/\\\t/', '/{"scalar":"(.*?)"}/s'], [chr(10), '', '    ', '$1'], $layout);
            }

            // Creates the JavaScript for config.
            if (empty($chart['config'])) {
                $config = '{}';
            } else {
                // Processes strings converted into objects (callbacks).
                $config = json_encode($chart['config'], JSON_NUMERIC_CHECK|JSON_UNESCAPED_SLASHES);
                $config = preg_replace(['/\\\n/', '/\\\r/', '/\\\t/', '/{"scalar":"(.*?)"}/s'], [chr(10), '', '    ', '$1'], $config);
            }
            
            // Creates the Javascript for the chart.
            $javaScriptFooterInlineCode[$chartId][] = 'Plotly.newPlot(\'plotly' . $chartId . '\', ' . $data . ', ' . $layout . ', ' . $config . ');';      
            
            // Adds the chart JavaScript.
            $pageRenderer->addJsFooterInlineCode($chartId, implode(chr(10), $javaScriptFooterInlineCode[$chartId]));

            $generatedCharts[] = [
                'type' => 'PlotlyCharts',
                'chartId' => $chartId,
                'width' => $chart['width'],
                'height' => $chart['height'],
            ];              
        }
        // Add the latest Plotly.js file.
        $javaScriptRootDirectory = ExtensionManagementUtility::extPath('sav_charts') . DefaultController::$javaScriptRootPath . '/Plotly';
        $javaScriptFiles = scandir($javaScriptRootDirectory, SCANDIR_SORT_DESCENDING);
        $javaScriptFooterFile = 'EXT:sav_charts/' . DefaultController::$javaScriptRootPath . '/Plotly/' . $javaScriptFiles[0];
        $pageRenderer->addJsFooterFile($javaScriptFooterFile);
        
        // Add the css file.
        $cssFile = 'EXT:sav_charts/' . DefaultController::$cssPath;
        $pageRenderer->addCssFile($cssFile);

        // Add the generated charts in the variable provider.
        $variableProvider->add('charts', $generatedCharts); 
    }
}
