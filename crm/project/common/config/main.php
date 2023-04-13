<?php
return [
    'language' => 'ru-RU', 
    'name' => 'GeoKadastr',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ], //секция компонентов
        'sourceLanguage' => 'en',
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'forceTranslation' => true,
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ]
                ],
            ],
        ],
    ],
];
