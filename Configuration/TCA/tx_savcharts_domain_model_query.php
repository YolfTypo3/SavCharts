<?php

defined('TYPO3_MODE') or die();

if (version_compare(\YolfTypo3\SavCharts\Controller\DefaultController::getTypo3Version(), '10.0', '<')) {
    $interface = [
    	'showRecordFieldList' => 'hidden,title,database_id,select_clause,from_clause,where_clause,groupby_clause,orderby_clause,limit_clause'
    ];
} else {
    $interface = [];
}
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:sav_charts/Resources/Public/Icons/icon_tx_savcharts_domain_model_query.gif',
    ],
    'interface' => $interface,
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type'  => 'check',
                'default' => 0,
            ]
        ],
        'title' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.title',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim'
            ],
        ],
        'database_id' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.database_id',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.database_id.I.0', 0],
                ],
                'foreign_table' => 'tx_savcharts_domain_model_database',
                'foreign_table_where' => 'AND 1 ',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'select_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.select_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
        'from_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.from_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
        'where_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.where_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
        'groupby_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.groupby_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '2',
            ],
        ],
        'orderby_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.orderby_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '2',
            ],
        ],
        'limit_clause' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_query.limit_clause',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '2',
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden, title, database_id, select_clause, from_clause, where_clause, groupby_clause, orderby_clause, limit_clause',
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => '']
    ],
];

?>