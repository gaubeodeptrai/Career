<?php

$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id' => 'app',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'language' => 'en-US',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'pdfjs' => [
            'class' => '\yii2assets\pdfjs\Module',
            'waterMark'=>[
                'text'=> 'Arcadia career',
                'color'=> 'red',
                'alpha'=>'0.3'
            ]
        ],
      /* 'user' => [
          'class' => 'dektrium\user\Module',
       ],*/
    ],
    'components' => [
       
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dwZwSDpLLasD1VriV4GZUDIE8seVj-N6',
        ],
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'info@deborah.vn',
            'password' => 'deborah123',
            'port' => '587', // Port 25 is a very common port too
            'encryption' => 'tls', // It is often used, check your provider or mail server 
            
           ],
        ],
        'urlManager' => [
            'rules' => [
                '<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
            ],
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [YII_DEBUG ? 'jquery.js' : 'jquery.min.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
            ],
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

//return array_merge_recursive($config, require($webroot . '/vendor/noumo/easyii/config/easyii.php'));
$config = array_merge_recursive($config,
    require($webroot . '/vendor/developeruz/easyii-user-module/config/user_module_config.php'),
    require($webroot . '/vendor/noumo/easyii/config/easyii.php'));
$config['components']['user'] = [ 'identityClass' => 'developeruz\easyii_user\models\User' ];
return $config;