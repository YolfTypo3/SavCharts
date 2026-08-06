<?php

defined('TYPO3') or die();

(function () {

    // Configures the Dispatcher
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'SavCharts',
        'Default',
        // Cachable controller actions
        [
            \YolfTypo3\SavCharts\Controller\DefaultController::class => 'show',
        ],
        // Non-cachable controller actions
        [],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // Adds a hook for the query manager
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass']['savcharts'] = \YolfTypo3\SavCharts\Hooks\SavChartsQueryManager::class;

})();

