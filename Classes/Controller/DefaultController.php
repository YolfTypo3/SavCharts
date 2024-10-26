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
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use YolfTypo3\SavCharts\Domain\Repository\QueryRepository;
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
    protected static string $cssPath = 'Resources/Public/Css/SavCharts.css';

    /**
     * js root path
     *
     * @var string
     */
    protected static string $javaScriptRootPath = 'Resources/Public/JavaScript';

    /**
     * Query repository
     *
     * @var QueryRepository
     *
     */
    protected QueryRepository $queryRepository;

    /**
     * @var FrontendConfigurationManager
     */
    protected $frontendConfigurationManager;
    
    /**
     * Injects the query repository.
     *
     * @param QueryRepository $queryRepository
     *
     * @return void
     */
    public function injectQueryRepository(QueryRepository $queryRepository): void
    {
        $this->queryRepository = $queryRepository;
    }
    
    public function injectFrontendConfigurationManager(FrontendConfigurationManager $frontendConfigurationManager)
    {
        $this->frontendConfigurationManager = $frontendConfigurationManager;
    }
    
    /**
     * Injects the request (can be used when sav_jpgraph is called from another extension).
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
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction(): void
    {
        // Gets the extension key
        $extensionKey = $this->request->getControllerExtensionKey();

        // Checks if the static extension template is included
        $typoScriptSetup = $this->frontendConfigurationManager->getTypoScriptSetup($this->request);
        $pluginSetupName = 'tx_' . strtolower($this->request->getControllerExtensionName()) . '.';
        if (! is_array($typoScriptSetup['plugin.'][$pluginSetupName]['view.'] ?? null)) {
            throw new \RuntimeException('You have to include the static template of the extension ' . $extensionKey . '.');
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
     * Gets the query repository
     *
     * @return QueryRepository
     */
    public function getQueryRepository(): QueryRepository
    {
        return $this->queryRepository;
    }

    /**
     * Gets the content object renderer
     *
     * @return ContentObjectRenderer
     */
    public function getContentObjectRenderer(): ContentObjectRenderer
    {
        $contentObject = $this->request->getAttribute('currentContentObject');

        return $contentObject;
    }

    /**
     * Gets the extension key
     *
     * @return string
     */
    public function getExtensionKey(): string
    {
        return $this->request->getControllerExtensionKey();
    }

    /**
     * show action
     *
     * @return ResponseInterface
     */
    public function showAction(): ResponseInterface
    {
        // Gets the extension key
        $extensionKey = $this->getExtensionKey();

        // Creates the xml parser
        $xmlParser = GeneralUtility::makeInstance(XmlParser::class);
        $xmlParser->injectController($this);
        $xmlParser->clearXmlTagResults();

        // Loads the markers and processes them
        $xmlParser->loadXmlString($this->settings['flexform']['xmlMarkersConfig']);
        $xmlParser->parseXml();

        // Sets markers defined by typoscript
        $typoScriptService = GeneralUtility::makeInstance(TypoScriptService::class);
        $typoScriptConfiguration = $typoScriptService->convertPlainArrayToTypoScriptArray($this->getSettings());
        if (is_array($typoScriptConfiguration['marker.'] ?? null)) {
            $typoScriptMarkers = $typoScriptConfiguration['marker.'];
            foreach ($typoScriptMarkers as $typoScriptMarkerKey => $typoScriptMarker) {
                if (strpos($typoScriptMarkerKey, '.') === false) {
                    $typoScriptValue = $this->getContentObjectRenderer()->cObjGetSingle($typoScriptMarker, $typoScriptMarkers[$typoScriptMarkerKey . '.']);
                    $xmlTagObject = XmlParser::getXmlTagObject('marker');
                    $xmlTagObject->setXmlTagId($typoScriptMarkerKey);
                    $xmlTagObject->setXmlTagValue($typoScriptValue);
                    XmlParser::setXmlTagResult('marker', $typoScriptMarkerKey, $xmlTagObject);
                }
            }
        }

        // Loads the queries and processes them
        $xmlParser->loadXmlString($this->settings['flexform']['xmlQueriesConfig']);
        $xmlParser->parseXml();

        // Loads the data and processes them
        $xmlParser->loadXmlString($this->settings['flexform']['xmlDataConfig']);
        $xmlParser->parseXml();

        // Loads the templates and processes them
        $xmlParser->loadXmlString($this->settings['flexform']['xmlTemplatesConfig']);
        $xmlParser->parseXml();

        // Post-processing to get the javascript
        $result = $xmlParser->postProcessing();

        $canvases = $result['canvases'];
        foreach ($canvases as $canvas) {
            $this->addJavaScriptFooterInlineCode($canvas['chartId'], $result['javaScriptFooterInlineCode']);
        }

        // Adds the latest javascript file
        $javaScriptRootDirectory = ExtensionManagementUtility::extPath($extensionKey) . self::$javaScriptRootPath;
        $javaScriptFiles = scandir($javaScriptRootDirectory, SCANDIR_SORT_DESCENDING);
        $javaScriptFooterFile = 'EXT:' . $extensionKey . '/' . self::$javaScriptRootPath . '/' . $javaScriptFiles[0];
        $this->addJavaScriptFooterFile($javaScriptFooterFile);

        // Adds the css file
        $cssFile = 'EXT:' . $extensionKey . '/' . self::$cssPath;
        $this->addCascadingStyleSheet($cssFile);

        // Adds the canvases to the view
        $this->view->assign('canvases', $canvases);

        return $this->htmlResponse($this->view->render());
    }

    /**
     * Formats a configuration
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function formatConfiguration(string $key, string $value): string
    {
        if (is_string($value)) {
            $value = '\'' . $value . '\'';
        }
        return $key . ':' . $value;
    }

    /**
     * Adds a javaScript file
     *
     * @param string $javaScriptFileName
     *
     * @return void
     */
    protected function addJavaScriptFooterFile(string $javaScriptFileName): void
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterFile($javaScriptFileName);
    }

    /**
     * Adds a javaScript inline code
     *
     * @param string $key
     * @param string $javaScriptFileName
     *
     * @return void
     */
    protected function addJavaScriptFooterInlineCode(string $key, string $javaScriptInlineCode): void
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterInlineCode($key, $javaScriptInlineCode);
    }

    /**
     * Adds a cascading style Sheet
     *
     * @param string $cascadingStyleSheet
     *
     * @return void
     */
    protected function addCascadingStyleSheet(string $cascadingStyleSheet): void
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile($cascadingStyleSheet);
    }

    /**
     * Adds an error to the errors array
     *
     * @param string $key
     *            The message key
     * @param array $arguments
     *            The argument array
     *
     * @return bool Returns always false so that it can be used in return statements
     */
    public function addError(string $key, array $arguments = null): bool
    {
        // Gets the extension key
        $extensionKey = $this->getExtensionKey();

        // Sets the message
        $message = LocalizationUtility::translate($key, $extensionKey, $arguments);

        if ($message === null) {
            $message = $key;
        }

        $this->addFlashMessage($message, $key, ContextualFeedbackSeverity::ERROR);
        return false;
    }

}
