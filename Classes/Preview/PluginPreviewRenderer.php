<?php

declare(strict_types=1);

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

namespace YolfTypo3\SavCharts\Preview;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Schema\Capability\TcaSchemaCapability;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PluginPreviewRenderer extends StandardContentPreviewRenderer
{
    
    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {

        $typo3Version = new (Typo3Version::class);
        // @todo Remove in TYPO3V15
        if ($typo3Version->getMajorVersion() == 13) {
            $outHeader = $this->renderPageModulePreviewHeaderForV13($item);
        } else {
            $outHeader = $this->renderPageModulePreviewHeaderForV14($item);
        }
        
        return $outHeader;  
    }
    
    protected function renderPageModulePreviewHeaderForV13(GridColumnItem $item): string
    {
        $record = $item->getRecord();        
        $itemLabels = $item->getContext()->getItemLabels();
        $table = $item->getTable();
        $outHeader = '';
        
        $headerLayout = (string)($record['header_layout'] ?? '');
        if ($headerLayout === '100') {
            $headerLayoutHiddenLabel = $this->getLanguageService()->sL('LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.6');
            $outHeader .= '<div class="element-preview-header-status">' . htmlspecialchars($headerLayoutHiddenLabel) . '</div>';
        }
        
        $date = (string)($record['date'] ?? '');
        if ($date !== '0' && $date !== '') {
            $dateLabel = $itemLabels['date'] . ' ' . BackendUtility::date($record['date']);
            $outHeader .= '<div class="element-preview-header-date">' . htmlspecialchars($dateLabel) . ' </div>';
        }
        
        $labelField = $GLOBALS['TCA'][$table]['ctrl']['label'] ?? '';
        $label = (string)($record[$labelField] ?? '');
        if ($label !== '') {
            
            // Modifies the label.
            $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            $sheets = $flexFormService->convertFlexFormContentToSheetsArray($record['pi_flexform']);
            $label = $this->modifyLabel($label, $sheets);
            
            $outHeader .= '<div class="element-preview-header-header">' . $this->linkEditContent($this->renderText($label), $record, $table) . '</div>';
        }
        
        $subHeader = (string)($record['subheader'] ?? '');
        if ($subHeader !== '') {
            $outHeader .= '<div class="element-preview-header-subheader">' . $this->linkEditContent($this->renderText($subHeader), $record) . '</div>';
        }
        
        return $outHeader;
        
    }
    
    protected function renderPageModulePreviewHeaderForV14(GridColumnItem $item): string
    {
        $record = $item->getRecord()->getRawRecord() ?? $item->getRecord();
        // @extensionScannerIgnoreLine
        $request = $item->getContext()->getCurrentRequest();
        if (!$this->tcaSchemaFactory->has($record->getFullType())) {
            return '';
        }
        
        $schema = $this->tcaSchemaFactory->get($item->getTable());
        $outHeader = '';
        
        if ($record->has('header_layout')) {
            $headerLayout = (string)$record->get('header_layout');
            if ($headerLayout === '100') {
                $headerLayoutHiddenLabel = $this->getLanguageService()->sL('LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.6');
                $outHeader .= '<div class="element-preview-header-status">' . htmlspecialchars($headerLayoutHiddenLabel) . '</div>';
            }
        }
        
        $dateLabel = $this->fieldProcessor->prepareFieldWithLabel($record, 'date');
        if ($dateLabel) {
            $outHeader .= '<div class="element-preview-header-date">' . htmlspecialchars(strip_tags($dateLabel)) . ' </div>';
        }
        
        if ($schema->hasCapability(TcaSchemaCapability::Label)) {
            $labelFieldName = $schema->getCapability(TcaSchemaCapability::Label)->getPrimaryFieldName();
            $label = $this->fieldProcessor->prepareText($record, $labelFieldName);
            if ($label !== null) {
                
                // Modifies the label.
                $record = $item->getRecord();
                $sheets = $record->get('pi_flexform')->getSheets();
                $label = $this->modifyLabel($label, $sheets);
                
                $outHeader .= '<div class="element-preview-header-header">' . $this->fieldProcessor->linkToEditForm($label, $record, $request) . '</div>';
            }
        }
        
        $subHeader = $this->fieldProcessor->prepareText($record, 'subheader');
        if ($subHeader !== null) {
            $outHeader .= '<div class="element-preview-header-subheader">' . $this->fieldProcessor->linkToEditForm($subHeader, $record, $request) . '</div>';
        }
        
        return $outHeader;        
    }
    
    protected function modifyLabel(string $label, array $sheets): string
    {
        $parserType = $sheets['sDEF']['settings']['flexform']['parserType'] ?? 0;
        
        $fluidDebug = $sheets['fluidParser']['settings']['flexform']['fluidDebug'] ?? 0;
        $fluidParser = '(Fluid parser' . ($fluidDebug ? ' ' : ')');
        $xmlParser = '(XML parser)';
        $label .= ' ' . ($parserType == 1 ? $fluidParser : $xmlParser);
        $label .= ($parserType == 1 && $fluidDebug ? '<span style="color:red">-> Debug on!</span>)' : '');
             
        return $label;
    }
}