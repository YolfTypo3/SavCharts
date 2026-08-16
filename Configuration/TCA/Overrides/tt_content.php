<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

$typo3Version = new (Typo3Version::class);
if ($typo3Version->getMajorVersion() == 13) {
	// Registers the Plugin to be listed in the Backend.
	$pluginSignature = ExtensionUtility::registerPlugin(
	    'SavCharts',
		'Default',
		'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
	    'ext-savcharts-wizard',
		'plugins',
		'Extension which displays charts using the chart.js library'
	);

	// Activates the display of the FlexForm field
	ExtensionManagementUtility::addToAllTCAtypes(
		'tt_content',
		'pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,--div--;Configuration,pi_flexform,',
		$pluginSignature,
		'after:subheader',
	);

	// @extensionScannerIgnoreLine
	ExtensionManagementUtility::addPiFlexFormValue(
		'*',
	    'FILE:EXT:sav_charts/Configuration/Flexforms/ExtensionFlexform.xml',
	    $pluginSignature
	);
} else {
	$pluginSignature = ExtensionUtility::registerPlugin(
	    'SavCharts',
		'Default',
		'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
	    'ext-savcharts-wizard',
		'plugins',
		'Extension which displays charts using the chart.js library',
	    'FILE:EXT:sav_charts/Configuration/Flexforms/ExtensionFlexform.xml',
	);
}


// Adds addToInsertRecords() if any
