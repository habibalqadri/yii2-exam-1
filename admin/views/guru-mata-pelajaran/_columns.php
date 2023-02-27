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
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'cari_guru',
        'value' => 'guru.nama_guru',

    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Akun',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) use ($id) {
                return Html::a('Hapus', ['delete', 'id' => $id, 'id_guru_mapel' => $model->id], [
                    'class' => 'btn btn-danger',
                    'role' => 'modal-remote', 'title' => 'Hapus',
                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Peringatan',
                    'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
                ]);
            },

        ]
    ],

    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'mata_pelajaran.mata_pelajaran',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view} ',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'Lihat', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Ubah', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Hapus',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Peringatan',
            'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
        ],
    ],

];
