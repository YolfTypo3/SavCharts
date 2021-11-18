<?php

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
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use YolfTypo3\SavCharts\Domain\Repository\QueryRepository;
use YolfTypo3\SavCharts\XmlParser\XmlParser;

/**
 * Default Controller
 */
class DefaultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Css path
     *
     * @var string
     */
    protected static $cssPath = 'Resources/Public/Css/SavCharts.css';

    /**
     * js root path
     *
     * @var string
     */
    protected static $javaScriptRootPath = 'Resources/Public/JavaScript';

    /**
     * Query repository
     *
     * @var QueryRepository
     *
     */
    protected $queryRepository;

    /**
     * Injects the query repository.
     *
     * @param QueryRepository $queryRepository
     */
    public function injectQueryRepository(QueryRepository $queryRepository)
    {
        $this->queryRepository = $queryRepository;
    }

    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        // Gets the extension key
        $extensionKey = $this->request->getControllerExtensionKey();

        // Checks if the static extension template is included
        /** @var FrontendConfigurationManager $frontendConfigurationManager */
        $frontendConfigurationManager = GeneralUtility::makeInstance(FrontendConfigurationManager::class);
        $typoScriptSetup = $frontendConfigurationManager->getTypoScriptSetup();
        $pluginSetupName = 'tx_' . strtolower($this->request->getControllerExtensionName()) . '.';
        if (! @is_array($typoScriptSetup['plugin.'][$pluginSetupName]['view.'])) {
            die('Fatal error: You have to include the static template of the extension ' . $extensionKey . '.');
        }
    }

    /**
     * Gets the settings
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Gets the query repository
     *
     * @return QueryRepository
     */
    public function getQueryRepository()
    {
        return $this->queryRepository;
    }

    /**
     * Gets the content object renderer
     *
     * @return ContentObjectRenderer
     */
    public function getContentObjectRenderer()
    {
        // @extensionScannerIgnoreLine
        $contentObject = $this->configurationManager->getContentObject();

        return $contentObject;
    }

    /**
     * Gets the extension key
     *
     * @return string
     */
    public function getExtensionKey()
    {
        return $this->request->getControllerExtensionKey();
    }

    /**
     * show action
     *
     * @return void|ResponseInterface
     */
    public function showAction()
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
        if (is_array($typoScriptConfiguration) && is_array($typoScriptConfiguration['marker.'])) {
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
        $extensionWebPath = self::getExtensionWebPath($extensionKey);
        $javaScriptFooterFile = $extensionWebPath . self::$javaScriptRootPath . '/' . $javaScriptFiles[0];
        $this->addJavaScriptFooterFile($javaScriptFooterFile);

        // Adds the css file
        $extensionWebPath = self::getExtensionWebPath($extensionKey);
        $cssFile = $extensionWebPath . self::$cssPath;
        $this->addCascadingStyleSheet($cssFile);

        // Adds the canvases to the view
        $this->view->assign('canvases', $canvases);

        // For TYPO3 V11: action must return an instance of Psr\Http\Message\ResponseInterface
        if (method_exists($this, 'htmlResponse')) {
            return $this->htmlResponse($this->view->render());
        }
    }

    /**
     * Formats a configuration
     *
     * @param string $key
     * @param mixed $value
     *
     * @return string
     */
    protected function formatConfiguration($key, $value)
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
    protected function addJavaScriptFooterFile(string $javaScriptFileName)
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
    protected function addJavaScriptFooterInlineCode(string $key, string $javaScriptInlineCode)
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
    protected function addCascadingStyleSheet(string $cascadingStyleSheet)
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

        $this->addFlashMessage($message, $key, FlashMessage::ERROR);
        return false;
    }

    /**
     * Gets the relative web path of a given extension.
     *
     * @param string $extension
     *            The extension
     *
     * @return string The relative web path
     */
    protected static function getExtensionWebPath(string $extension): string
    {
        $extensionWebPath = PathUtility::getAbsoluteWebPath(ExtensionManagementUtility::extPath($extension));
        if ($extensionWebPath[0] === '/') {
            // Makes the path relative
            $extensionWebPath = substr($extensionWebPath, 1);
        }
        return $extensionWebPath;
    }

    /**
     * Sets the controller context.
     *
     * This method is called by sav_library_plus when graph items
     * are used (for TYPO3 versions below V11 only).
     *
     * @todo Will be removed with TYPO3 V13.
     *
     * @return void
     */
    public function setControllerContext()
    {
        $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
        if (version_compare($typo3Version->getVersion(), '11.0', '<')) {
            $requestBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Mvc\Web\RequestBuilder::class);

            $requestBuilder->injectConfigurationManager($this->configurationManager);
            $requestBuilder->injectObjectManager($this->objectManager);
            $requestBuilder->injectExtensionService($this->objectManager->get(\TYPO3\CMS\Extbase\Service\ExtensionService::class));
            $requestBuilder->injectEnvironmentService($this->objectManager->get(\TYPO3\CMS\Extbase\Service\EnvironmentService::class));
            $this->response = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Mvc\Web\Response::class);
            $this->request = $requestBuilder->build();

            $this->uriBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder::class);
            $this->controllerContext = $this->buildControllerContext();
            $flashMessageService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessageService::class);
            $this->controllerContext->injectFlashMessageService($flashMessageService);
        }
    }
}
