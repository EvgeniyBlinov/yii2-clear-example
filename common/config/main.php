<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require(\Yii::getAlias('@common') . '/config/db.php'),

        // translations
        //'i18n' => [
            //'translations' => [
                //'app*' => [
                    //'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@common/messages',
                    ////'sourceLanguage' => 'en-US',
                    //'fileMap' => [
                        //'app' => 'app.php',
                        //'app/error' => 'error.php',
                    //],
                //],
            //],
        //],

    ],
];
