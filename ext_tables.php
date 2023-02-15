<?php
defined('TYPO3') or die();

(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_savcharts_domain_model_database');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_savcharts_domain_model_query');
})();

