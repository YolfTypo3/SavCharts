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

namespace YolfTypo3\SavCharts\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use YolfTypo3\SavCharts\FluidParser\FluidParser;
use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * Default Controller
 */
final class DefaultController extends ActionController
{
    
    /**
     * Css path
     *
     * @var string
     */
    public static string $cssPath = 'Resources/Public/Css/SavCharts.css';

    /**
     * JavaScript root path
     *
     * @var string
     */
    public static string $javaScriptRootPath = 'Resources/Public/JavaScript';
   
    /**
     * Gets the request.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
    
    /**
     * Sets the request (can be used when sav_jpgraph is called from another extension).
     *
     * @param RequestInterface $request
     *
     * @return void
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    /**
     * Initializes the controller.
     *
     * @return void
     */
    protected function initializeAction(): void
    {        
        // Gets the extension key
        $extensionKey = $this->request->getControllerExtensionKey();

        // Checks if the extension is included in the site configuration
        $lowerCamelExtensionKey = GeneralUtility::underscoredToLowerCamelCase($extensionKey);
        $siteSettings = $this->request->getAttribute('site')->getSettings();
        if (! $siteSettings->has($lowerCamelExtensionKey)) {
            throw new \RuntimeException('You have to include the extension ' . $extensionKey . ' in the site setup.');
        }
    }

    /**
     * Gets the settings
     *
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * show action
     *
     * @return ResponseInterface
     */
    public function showAction(): ResponseInterface
    {
        $parserType = $this->settings['flexform']['parserType'] ?? 0;
        
        if ($parserType == 1) {
            // Creates the Fluid parser.
            $fluidParser = GeneralUtility::makeInstance(FluidParser::class, $this->view, $this->settings);
            $canvases = $fluidParser->parse();      
        } elseif ($parserType == 0) {
            // Creates the XML parser.
            $xmlParser = GeneralUtility::makeInstance(XmlParser::class);
            $xmlParser->injectController($this);
            $xmlParser->clearXmlTagResults();
            $canvases = $xmlParser->parse();
        }
        // Adds the canvases to the view.
        $this->view->assign('canvases', $canvases);
        
        return $this->htmlResponse($this->view->render());
    }

}
