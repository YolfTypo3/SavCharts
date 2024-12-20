<?php
defined('TYPO3') or die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:sav_charts/Resources/Public/Icons/icon_tx_savcharts_domain_model_database.gif',
    ],
    'interface' => [],
    'columns' => [
        'cruser_id' => [
            'exclude' => true,
            'label' => 'cruser_id',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'default' => 0
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type'  => 'check',
                'default' => 0,
            ]
        ],
        'title' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'driver' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.driver',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'tables' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.tables',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ],
        ],
        'host' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.host',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'port' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.port',
            'config' => [
                'type'  => 'number',
                'size'  => 4,
                'range' => [
                    'upper'  => 999999,
                    'lower'  => 0
                ],
                'default' => 0
            ],
        ],
        'socket' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.socket',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'name' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'username' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.username',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'userpassword' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.userpassword',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'persistent' => [
            'exclude' => 1,
            'label'  => 'LLL:EXT:sav_charts/Resources/Private/Language/locallang_db.xlf:tx_savcharts_domain_model_database.persistent',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden, title, driver, tables, host, port, socket, name, username, userpassword, persistent',
            'columnsOverrides' => [
            ],
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => '']
    ],
];
