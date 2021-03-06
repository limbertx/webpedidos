<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es', 
    'timeZone' => 'America/La_Paz',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'odxWqEO23Wzm7kof30j_hAI-ZnNpWTgx',
            'parsers' =>    [
                            'application/json' => 'yii\web\JsonParser',
                            ]                        
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'site',
                    'extraPatterns' => [
                        'GET about' => 'about',
                        'GET contact' => 'contact',
                        'GET login' => 'login'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'clientes',
                    'extraPatterns' => [
                        'GET index' => 'index',
                        'GET create' => 'create',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'productos',
                    'extraPatterns' => [
                        'GET index' => 'index',
                        'GET view/<id>' => 'view',
                        'GET create' => 'create',
                        'POST create' => 'create',
                        'POST update/<id>' => 'update'
                    ]

                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'pedidos'
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'restpedidos',
                    'extraPatterns' => [
                        'GET getproductos' => 'getproductos',
                        'POST setpedido' => 'setpedido',
                        'GET getcliente/<telefono>' => 'getcliente',
                        'POST updatecliente' => 'updatecliente',
                        'POST updatetoken' => 'updatetoken',
                        'GET getpedidos/<pkCliente>' => 'getpedidos',
                    ]
                ],

            ],
        ],
        
    ],
    'params' => $params,
];

/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
*/

return $config;
