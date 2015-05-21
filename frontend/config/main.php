<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl'             => '/',
    'components'          => [
        'request' => [
            'baseUrl' => '',
        ],
        //'user' => [
            //'identityClass'   => 'common\models\User',
            //'enableAutoLogin' => true,
        //],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        //'urlManager' => [
            //'class'           => 'yii\web\UrlManager',
            //'enablePrettyUrl' => true,
            ////'baseUrl'  => '/',
            ////'basePath' => '/',
            ////'class'           => 'frontend\components\LangUrlManager',
            ////'hostInfo'            => 'http://alvion.blinov/',
            //'showScriptName'  => false,
            //'rules'           => [
                //'<locale:\w\w\/><controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //'/'                                            => 'site/index',
                //'/contacts/?'                                 => (defined('YII_ENV') && YII_ENV == 'rc') ? 'site/index' : 'site/contact',
                //'/about/?'                                    => (defined('YII_ENV') && YII_ENV == 'rc') ? 'site/index' : 'site/about',
                ////'/blog\/<id:\d+>'                              => (defined('YII_ENV') && YII_ENV == 'rc') ? 'site/index' : 'site/blog',
                //[
                    //'pattern'  => '/blog/?<id:\d+>',
                    //'route'    => (defined('YII_ENV') && YII_ENV == 'rc') ? 'site/index' : 'site/blog',
                    //'defaults' => ['id' => 0],
                //],
                //[
                    //'pattern'  => '/projects/?<id:\d+>',
                    //'route'    => (defined('YII_ENV') && YII_ENV == 'rc') ? 'site/index' : 'site/projects',
                    //'defaults' => ['id' => 0],
                //],
                //'GET /api/<action:\w+>/<arguments:[^$]+>'      => 'api/<action>',
                ////'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ////'GET /api/v1/<action:\w+>'  => 'api/<action>',
                ////'/news'                    => 'bulletin/index',
                ////'/projects'                => '/project/index',
            //]
        //],
        'errorHandler' => [
            'errorAction' => 'site/index',
        ],
    ],
    'params' => $params,
];
