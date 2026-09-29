<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use YolfTypo3\SavCharts\Controller\DefaultController;
use YolfTypo3\SavCharts\Hooks\SavChartsQueryManager;

defined('TYPO3') or die();

(function () {

    // Configures the Dispatcher
    ExtensionUtility::configurePlugin(
        'SavCharts',
        'Default',
        // Cachable controller actions
        [
            DefaultController::class => 'show',
        ],
        // Non-cachable controller actions
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // Adds a hook for the query manager.
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass']['savcharts'] = SavChartsQueryManager::class;
    
})();

