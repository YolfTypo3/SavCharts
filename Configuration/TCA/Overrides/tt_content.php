<?php
declare(strict_types=1);
defined('TYPO3') or die();

$typo3Version = new (\TYPO3\CMS\Core\Information\Typo3Version::class);
if ($typo3Version->getMajorVersion() == 13) {
	// Registers the Plugin to be listed in the Backend.
	$pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	    'SavCharts',
		'Default',
		'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
		null,
		'plugins',
		''
	);

	// Activates the display of the FlexForm field
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
		'tt_content',
		'pages;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:pages.ALT.list_formlabel,--div--;Configuration,pi_flexform,',
		$pluginSignature,
		'after:subheader',
	);

	// @extensionScannerIgnoreLine
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
		'*',
	    'FILE:EXT:sav_charts/Configuration/Flexforms/ExtensionFlexform.xml',
	    $pluginSignature
	);
} else {
	$pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	    'SavCharts',
		'Default',
		'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
		null,
		'plugins',
		''
	);
}


// Adds addToInsertRecords() if any
