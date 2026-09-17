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
 * A viewHelper for charts.
 *
 * @package SavLibraryKickstarter
 */
final class EChartsViewHelper extends AbstractSavChartsViewHelper
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
        
            // Creates the JavaScript for options.
            if (empty($chart['options'])) {
                $options = '{}';
            } else {
                // Processes strings converted into objects (callbacks).
                $options = json_encode($chart['options'], JSON_NUMERIC_CHECK);
                $options = preg_replace(['/\\\n/', '/\\\r/', '/\\\t/', '/{"scalar":"(.*?)"}/s'], [chr(10), '', '    ', '$1'], $options);
            }                                 
            $javaScriptFooterInlineCode[$chartId][] = 'var echart' . $chartId . ' = echarts.init(document.getElementById(\'echart' . $chartId . '\'));';
            $javaScriptFooterInlineCode[$chartId][] = 'var option' . $chartId . ' = ' . $options .';';
            $javaScriptFooterInlineCode[$chartId][] = 'echart' . $chartId . '.setOption(option' . $chartId . ');';
            
            // Adds the chart JavaScript.
            $pageRenderer->addJsFooterInlineCode($chartId, implode(chr(10), $javaScriptFooterInlineCode[$chartId]));                                

            $generatedCharts[] = [
                'type' => 'ECharts',
                'chartId' => $chartId,
                'width' => $chart['width'],
                'height' => $chart['height'],
            ];
        }        
        // Adds the latest echart.js file.
        $javaScriptRootDirectory = ExtensionManagementUtility::extPath('sav_charts') . DefaultController::$javaScriptRootPath . '/ECharts';
        $javaScriptFiles = scandir($javaScriptRootDirectory, SCANDIR_SORT_DESCENDING);
        $javaScriptFooterFile = 'EXT:sav_charts/' . DefaultController::$javaScriptRootPath . '/ECharts/' . $javaScriptFiles[0];  
        $pageRenderer->addJsFooterFile($javaScriptFooterFile);
        
        // Adds the css file.
        $cssFile = 'EXT:sav_charts/' . DefaultController::$cssPath;
        $pageRenderer->addCssFile($cssFile);
        
        // Adds the generated charts in the variable provider.
        $variableProvider->add('charts', $generatedCharts);     
    }
}
