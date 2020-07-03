<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Test_Task',
    'language' => 'ru-RU',
    'version' => '1.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        //'app\modules\cms\component\url_rules\UrlRule__Base'
    ],
    'aliases' => [
        /*
        '@name1' => 'path/to/path1',
        '@name2' => 'path/to/path2',
        */
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Indexapi',
        ],       
    ],    
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OxMNY4rPzGrhQ65JVYHexKMm9btlczLS',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]            
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true, // Enable versioning support
                'bundles' => [
                        'yii\web\JqueryAsset' => false, // Turn off generating JQuery
                    ],
            'linkAssets' => false, // Generation of direct links to files, without copying resources
        ],        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' =>  true,
            'rules' => [
                'GET /' => 'site/index',
                'GET /reactjs' => 'site/reactjs',
                'GET /about' => 'site/about',
                
                // API
                'GET /api/v1/hintword' => 'v1/hintword/index',
            ],
        ],
    ],
    'params' => $params,
];

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

return $config;
