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
use YolfTypo3\SavCharts\ViewHelpers;

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
        
        $template = $this->settings['flexform']['fluidMarkersConfig'];
        $template .= $this->settings['flexform']['fluidQueriesConfig'];
        $template .= $this->settings['flexform']['fluidDataConfig'];
        $template .= $this->settings['flexform']['fluidTemplatesConfig'];
   
        // Checks if the converter is allowed
        if ($this->settings['flexform']['allowConverter'] ?? false) {
            $template = str_replace('###INCLUDE_CONVERTER###', ($this->settings['flexform']['converterParser'] ?? ''), $template);
        } 
        
        // Gets the rendering contexts.
        $renderingContext = $templateView->getRenderingContext();
        $viewRenderingContext = $this->view->getRenderingContext();

        // Sets the viewHelper resolver.
        $viewHelperResolver = $viewRenderingContext->getViewHelperResolver();
        $viewHelperResolver->addNamespace('c', ViewHelpers::class);
        $renderingContext->setViewHelperResolver($viewHelperResolver);
        // Sets the variable provider.
        $variableProvider = $viewRenderingContext->getVariableProvider();
        $renderingContext->setVariableProvider($variableProvider);
        // Sets the controller action.
        $controllerAction = $viewRenderingContext->getControllerAction();
        $renderingContext->setControllerAction($controllerAction);
        // Sets the controller name.
        $controllerName = $viewRenderingContext->getControllerName();
        $renderingContext->setControllerName($controllerName);
        // Sets the template source
        $renderingContext->getTemplatePaths()->setTemplateSource($template);
        // Sets the the attribute
        $request = $viewRenderingContext->getAttribute(ServerRequestInterface::class);
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
        $result = $variableProvider->get('charts');
        
        return $result;
    }  
}
