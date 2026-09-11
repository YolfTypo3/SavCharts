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

namespace YolfTypo3\SavCharts\ViewHelpers;
 
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A viewHelper for callbacks.
 *
 * @package SavCharts
 */
final class PluginViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('chartId', 'string', 'Chart ID', true);
        $this->registerArgument('key', 'string', 'Plugin key', true);
        $this->registerArgument('fileName', 'string', 'File name containing the JavaScript function', false, '');
    }

    /**
     * Renders the viewHelper.
     *
     * @return void
     */
    public function render(): void
    {
        // Gets the arguments.
        $key = $this->arguments['key'];
        $chartId = $this->arguments['chartId'];
        $fileName = $this->arguments['fileName'];

        if (empty($fileName)) {
            $childrenValue = $this->renderChildren();
            $viewHelperVariableValue = $childrenValue;
        } else {
            $absFileName = GeneralUtility::getFileAbsFileName(trim($fileName));
            if ($absFileName !== null && file_exists($absFileName)) {
                $viewHelperVariableValue = file_get_contents($absFileName);
            } else {
                $message = sprintf(
                    'Plugin file "%s" does not exist.',
                    $fileName
                    );
                throw new \InvalidArgumentException($message);
            }
        }
        
        $this->mergeInVariableProvider('charts__', $chartId, ['plugins' => [$key => (object) $viewHelperVariableValue]]);
    }   
}
