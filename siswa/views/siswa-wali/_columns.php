<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

return [
    //[
    //'class' => 'kartik\grid\CheckboxColumn',
    //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'namaSiswa.nama',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'waliSiswa.nama',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'waliSiswa.alamat',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'waliSiswa.no_hp',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'waliSiswa.statusWali.status_wali',
    ],


    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Action',
        'template' => '{btn_view} {btn_update} {btn_delete}',
        'buttons' => [
            "btn_view" => function ($url, $model, $key) {
                return
                    Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['wali/view', 'id' => $model->waliSiswa->id], [

                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
            },
            "btn_update" => function ($url, $model, $key) {
                return
                    Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['wali/update', 'id' => $model->waliSiswa->id], [

                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
            },
            "btn_delete" => function ($url, $model, $key) {
                return
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', ['wali/delete', 'id' => $model->waliSiswa->id], [

                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
            },

        ]
    ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign' => 'middle',
    //     'urlCreator' => function ($action, $model, $key, $index) {
    //         return Url::to([$action, 'id_siswa' => $model->id_siswa, 'id_wali' => $model->id_wali]);
    //     },
    //     'viewOptions' => ['role' => 'modal-remote', 'title' => 'Lihat', 'data-toggle' => 'tooltip'],
    //     'updateOptions' => ['role' => 'modal-remote', 'title' => 'Ubah', 'data-toggle' => 'tooltip'],
    //     'deleteOptions' => [
    //         'role' => 'modal-remote', 'title' => 'Hapus',
    //         'data-confirm' => false, 'data-method' => false, // for overide yii data api
    //         'data-request-method' => 'post',
    //         'data-toggle' => 'tooltip',
    //         'data-confirm-title' => 'Peringatan',
    //         'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
    //     ],
    // ],

];
