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
        []
    );

    // Registers the icon
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'ext-savcharts-wizard',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:sav_charts/Resources/Public/Icons/ExtensionWizard.svg']
    );

    // Adds a hook for the query manager
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass']['savcharts'] = \YolfTypo3\SavCharts\Hooks\SavChartsQueryManager::class;

})();

