<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language' => 'ru-RU', 
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
			'enableCsrfValidation'=>false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '' => 'site/index',
                'sitemap' => 'site-map/index',
                'portfolio' => 'portfolio/index',
                'category' => 'category/index',
                'news' => 'news/index',
                'product' => 'product/index',
                'services' => 'services/index',
                //'collection' => 'collection/index',
                //'<action>'=>'site/<action>',
                'contact' => 'site/contact',
                'about' => 'site/about',
                //'faq' => 'site/faq',
                //'delivery' => 'site/delivery',
                'confidentiality' => 'site/confidentiality',
                'error' => 'site/error',
                'sale' => 'site/sale',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
				'request-password-reset' => 'site/request-password-reset',
				'verify-email' => 'site/verify-email',
                'sendmail' => 'main/default/sendmail',
                '<slug:[\w\-]+>' => 'site/view',
                'services/stock' => 'services/stock',
                '<controller:\w+>' => '<controller>/index',
                '<controller>/<slug:[\w\-]+>' => '<controller>/view',
            ],
        ],
		'mailer' => [
				'class' => 'yii\swiftmailer\Mailer',
				'useFileTransport' => false,
				'transport' => [
					'class' => 'Swift_SmtpTransport',
					'host' => 'smtp.yandex.ru',
					'username' => 'shedevr3xa@yandex.ru',
					'password' => 'Shedevr25.90',
					'port' => '587',
					'encryption' => 'tls',
				],
				],
    ],
    'params' => $params,
    'aliases' => [
        '@images' => dirname(dirname(__FILE__, 3)) . '/uploads',
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}