<?php

use kartik\icons\Icon;
use kartik\grid\ActionColumn;
use yii\bootstrap4\Html;
use yii\helpers\Url;

Icon::map($this);

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
        'value' => 'waliSiswa.nama',
        'attribute' => 'nama_wali',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'value' => 'waliSiswa.alamat',
        'attribute' => 'alamat_wali',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'value' => 'waliSiswa.no_hp',
        'attribute' => 'no_hp_wali',
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
                    Html::a('<i class="far fa-eye"></i>', ['wali/view', 'id' => $model->waliSiswa->id], [

                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
            },
            "btn_update" => function ($url, $model, $key) {
                return
                    Html::a('<i class="fas fa-edit"></i>', ['wali/update', 'id' => $model->waliSiswa->id], [

                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
            },
            "btn_delete" => function ($url, $model, $key) {
                return
                    Html::a('<i class="fas fa-trash"></i>', ['wali/delete', 'id' => $model->waliSiswa->id], [
                        'role' => 'modal-remote', 'title' => 'Hapus',
                        'data-confirm' => false, 'data-method' => false, // for overide yii data api
                        'data-request-method' => 'post',
                        'data-toggle' => 'tooltip',
                        'data-confirm-title' => 'Peringatan',
                        'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
                    ]);
            },

        ],

    ],
    // [
    //     'class' => 'common\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign' => 'middle',
    //     'urlCreator' => function ($action, $model, $key, $index) {
    //         return Url::to([$action, 'id_siswa' => $model->id_siswa, 'id_wali' => $model->id_wali]);
    //     },
    //     'viewOptions' => ['role' => 'modal-remote', 'title' => 'Lihat', 'data-toggle' => 'tooltip'],
    //     'updateOptions' => [
    //         'role' => 'modal-remote',
    //         'title' => 'Ubah',
    //         'data-toggle' =>
    //         'tooltip',

    //     ],
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
