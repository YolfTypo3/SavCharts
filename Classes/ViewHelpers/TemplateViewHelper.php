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
use TYPO3Fluid\Fluid\View\TemplateView;

/**
 * A view helper for the template tag.
 *
 *
 * @package SavCharts
 */
final class TemplateViewHelper extends AbstractSavChartsViewHelper
{
   
    /**
     * Initializes arguments.
     *
     * return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Template id', true);
        $this->registerArgument('fileName', 'string', 'File name containing the template', false, '');
    }

    /**
     * Renders the view helper.
     *
     * @return void
     */
    public function render()
    {
        // Gets the arguments.
        $id = $this->arguments['id'];
        $fileName = $this->arguments['fileName'];
        
        if (empty($fileName)) {
            $fileName = $this->renderChildren();
        } 

        $absFileName = GeneralUtility::getFileAbsFileName(trim($fileName));
        if ($absFileName !== null && file_exists($absFileName)) {
            $template = '{namespace c=YolfTypo3\\SavCharts\\ViewHelpers}';    
            $template .= file_get_contents($absFileName);
            /** @var TemplateView $view*/
            $view = GeneralUtility::makeInstance(TemplateView::class);

            // Sets information in the rendering context.
            $renderingContext = $view->getRenderingContext();
            $variableProvider = $this->renderingContext->getVariableProvider();
            $renderingContext->setVariableProvider($variableProvider);
            $controllerAction = $this->renderingContext->getControllerAction();
            $renderingContext->setControllerAction($controllerAction);
            $controllerName = $this->renderingContext->getControllerName();
            $renderingContext->setControllerName($controllerName);
            $renderingContext->getTemplatePaths()->setTemplateSource($template);
       
            return $view->render();
        } else {
            $message = sprintf(
                'Template file ""%s" does not exist.',
                $fileName
                );
            throw new \InvalidArgumentException($message);
        }       
    }
}
