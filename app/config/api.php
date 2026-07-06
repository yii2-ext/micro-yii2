<?php

/**
 * Config file, defined alias path and below make route for default one module
 * after define type request parser ( JSON - for RESTful )
 * and set database ( SQLite ), after again set rules for request controller (UrlManager) - with rewrite
 */
return [
    'id' => 'diary-api',

    'basePath' => realpath(__DIR__ . '/../'),

    'aliases' => [
        '@diary' => realpath(__DIR__.'/../'),
    ],

    'defaultRoute' => 'diary/diaries',

    'controllerMap' => [
        'diaries' => 'diary\modules\diary\controllers\DiariesController',
    ],

    'modules' => [
      'diary' => [
          'class' => 'diary\modules\diary\Module',
      ]
    ],

    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@diary/database/diary.db',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'diaries'
                ],
            ],
        ],
    ],

];

