<?php
defined('TYPO3') or die();

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['savcharts_default'] = 'layout,select_key';
// Adds the flexform field to plugin option
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['savcharts_default'] = 'pi_flexform';

// Adds the flexform DataStructure
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'savcharts_default',
    'FILE:EXT:sav_charts/Configuration/Flexforms/ExtensionFlexform.xml'
);

// Registers the Plugin to be listed in the Backend.
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'SavCharts',
	'Default',
	'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1'
);

// Adds addToInsertRecords() if any

