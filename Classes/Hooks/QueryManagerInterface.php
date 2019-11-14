<?php
namespace YolfTypo3\SavCharts\Hooks;

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

/**
 * Interface query managers
 */
interface QueryManagerInterface
{
    /**
     * Injects the controller
     *
     * @param \YolfTypo3\SavCharts\Controller\DefaultController $controller
     * @return void
     */
    public function injectController(\YolfTypo3\SavCharts\Controller\DefaultController $controller);

    /**
     * Executes the query
     *
     * @param int $queryId
     *            The query id
     * @return array The rows
     */
    public function executeQuery(int $queryId) :  array;

    /**
     * Injects the markers
     *
     * @param array $markers
     *            The markers array
     *
     * @return void
     */
    public function injectMarkers(array $markers);

}

?>