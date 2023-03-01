<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        //kode dibawah untuk mematikan bootstrap 3
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
                // 'yii\web\JqueryAsset' => [
                //     'js' => []
                // ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ]
            ]
        ],
        //end code
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // only support DbManager
        ],
        'pengguna' => [
            'class' => 'common\components\PenggunaComponent', // only support DbManager
        ],
    ],

    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'crud'   => [
                    'class' => 'common\generators\Generator',
                ]
            ]
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],


];
