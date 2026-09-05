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

namespace YolfTypo3\SavCharts\FluidParser;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3Fluid\Fluid\View\TemplateView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\View\ViewInterface;

/**
 * Class Fluid Parser
 */

class FluidParser
{
    
    public function __construct(
        private readonly ViewInterface $view,
        private readonly array $settings,
        ) {}
    
    /**
     * Parses the plugin configuration.
     *
     * @return array
     */
    public function parse(): mixed
    {
        /** @var TemplateView $templateView */
        $templateView = GeneralUtility::makeInstance(TemplateView::class);
        
        $template = '{namespace c=YolfTypo3\\SavCharts\\ViewHelpers}';
        $template .= $this->settings['flexform']['fluidMarkersConfig'];
        $template .= $this->settings['flexform']['fluidQueriesConfig'];
        $template .= $this->settings['flexform']['fluidDataConfig'];
        $template .= $this->settings['flexform']['fluidTemplatesConfig'];
        
        // Sets information in the rendering context.
        $renderingContext = $templateView->getRenderingContext();
        $variableProvider = $this->view->getRenderingContext()->getVariableProvider();
        $renderingContext->setVariableProvider($variableProvider);
        $controllerAction = $this->view->getRenderingContext()->getControllerAction();
        $renderingContext->setControllerAction($controllerAction);
        $controllerName = $this->view->getRenderingContext()->getControllerName();
        $renderingContext->setControllerName($controllerName);
        $renderingContext->getTemplatePaths()->setTemplateSource($template);
        $request = $this->view->getRenderingContext()->getAttribute(ServerRequestInterface::class);
        $renderingContext->setAttribute(ServerRequestInterface::class, $request);
        
        // Sets special variables.
        $debug = $this->settings['flexform']['fluidDebug'] ?? 0;
        // @extensionScannerIgnoreLine
        $contentUid = $request->getAttribute('currentContentObject')->data['uid'];
        $templateView->assignMultiple([
            'contentUid' => $contentUid,
            'debug' => $debug
        ]);
        
        // Renders the view.
        $templateView->render();
        
        // Gets the result from the Charts ViewHelper.
        $variableProvider = $templateView->getRenderingContext()->getVariableProvider();
        $result = $variableProvider->get('canvases');
        
        return $result;
    }  
}
