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

/**
 * A view helper for LineChart tag.
 *
 *
 * @package SavCharts
 */
final class LineChartViewHelper extends AbstractChartViewHelper
{
    protected $configuration = [
        'type' => 'line',
        'options' => [
            'scales' => [
                'y' => [
                    'beginAtZero' => 1
                ]
            ]
        ]
    ];
}
