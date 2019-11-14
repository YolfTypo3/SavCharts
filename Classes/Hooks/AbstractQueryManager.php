<?php
namespace YolfTypo3\SavCharts\Hooks;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use YolfTypo3\SavCharts\Controller\DefaultController;

/**
 * Abstract query manager
 */
abstract class AbstractQueryManager implements QueryManagerInterface
{

    /**
     * Controller
     *
     * @var \YolfTypo3\SavCharts\Controller\DefaultController
     */
    protected $controller;

    /**
     * Markers
     *
     * @var array
     */
    protected $markers = [];

    /**
     * Query
     *
     * @var array
     */
    protected $query = [];

    /**
     * Injects the controller
     *
     * @param \YolfTypo3\SavCharts\Controller\DefaultController $controller
     *
     * @return void
     */
    public function injectController(DefaultController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Injects the markers
     *
     * @param array $markers
     *            The markers array
     *
     * @return void
     */
    public function injectMarkers(array $markers)
    {
        if (! empty($markers)) {
            $this->markers = $markers;
        }
    }

    /**
     * Replaces markers in the query
     *
     * @param int $queryId
     *            The query id
     *
     * @return void
     */
    public function replaceMarkersInQuery(int $queryId)
    {
        // Creates the markers
        $markers = $this->markers;

        // Gets the typoScript custom query
        $typoScriptService = GeneralUtility::makeInstance(TypoScriptService::class);
        $typoScriptConfiguration = $typoScriptService->convertPlainArrayToTypoScriptArray($this->controller->getSettings());
        $isCustomQuery = is_array($typoScriptConfiguration) && is_array($typoScriptConfiguration['customQuery.']) && is_array($typoScriptConfiguration['customQuery.'][$queryId . '.']);
        if ($isCustomQuery) {
            $customQueryMarkers = $typoScriptConfiguration['customQuery.'][$queryId . '.'];
            $contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
            foreach ($customQueryMarkers as $customQueryMarkerKey => $customQueryMarker) {
                if (strpos($customQueryMarkerKey, '.') === false) {
                    $markers[$customQueryMarkerKey] = $contentObject->cObjGetSingle($customQueryMarker, $customQueryMarkers[$customQueryMarkerKey . '.']);
                }
            }
        }

        // Creates the markers keys
        $markersKeys = [];
        foreach (array_keys($markers) as $key => $value) {
            $markersKeys[$value] = '###' . $value . '###';
        }

        // Parses the query with the markers
        $this->query = str_replace($markersKeys, $markers, $this->query);
    }

    /**
     * Executes the query
     *
     * @param int $queryId
     *            The query id
     *
     * @return array The rows
     */
    public function executeQuery(int $queryId): array
    {
        return [];
    }
}

?>