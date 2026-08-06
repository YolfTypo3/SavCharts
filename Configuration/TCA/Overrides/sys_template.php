<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// Default TypoScript
ExtensionManagementUtility::addStaticFile(
    'sav_charts',
    'Configuration/TypoScript',
    'SAV Charts'
);