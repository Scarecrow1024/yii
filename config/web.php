<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
            'admin' => [
                'class' => 'app\modules\admin',
            ],
            'user' => [
                'class' => 'app\dektrium\Module',
                'confirmWithin' => 21600,
                'cost' => 12,
                'admins' => ['admin']
            ],
            'redactor' => [ 
                'class' => 'yii\redactor\RedactorModule', 
                'imageAllowExtensions'=>['jpg','png','gif'] 
            ], 
        ],
    'components' => [
        /*'urlManager'=>array(  
             'enablePrettyUrl' => true, //对url进行美化 
             'showScriptName' => false,//隐藏index.php   
             //'suffix' => '.html',//后缀
             'enableStrictParsing'=>FALSE,//不要求网址严格匹配，则不需要输入rules
             'rules' => []//网址匹配规则
        ),*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'niool',
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
           'viewPath' => '@app/mail', //使用模板文件在/mail/
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
           'transport' => [  
               'class' => 'Swift_SmtpTransport',  
               'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
               'username' => '15639128975@163.com',  
               'password' => 'zyf941024',  
               'port' => '25',  
               'encryption' => 'tls',  
                                   
                           ],   
           'messageConfig'=>[  
               'charset'=>'UTF-8',  
               'from'=>['15639128975@163.com'=>'niool']  
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
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

return $config;
