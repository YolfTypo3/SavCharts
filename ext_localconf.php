<?php

defined('TYPO3') or die();

(function () {

    // Configures the Dispatcher
    $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
    if (version_compare($typo3Version->getVersion(), '10.0', '<')) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'YolfTypo3.sav_charts',
            'Default',
            // Cachable controller actions
            [
                'Default' => 'show',
            ],
            // Non-cachable controller actions
            []
        );
    } else {
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
    }

    // Registers the icon
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'ext-savcharts-wizard',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:sav_charts/Resources/Public/Icons/ExtensionWizard.svg']
    );

    // Adds the page TSConfig for the Wizard Icon
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sav_charts/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig">'
    );

    // Adds a hook for the query manager
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass']['savcharts'] = \YolfTypo3\SavCharts\Hooks\SavChartsQueryManager::class;

})();

