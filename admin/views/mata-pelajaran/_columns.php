<?php

use yii\helpers\Url;
use kartik\grid\CheckboxColumn;
use yii\bootstrap4\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'name' => 'pilihHapus',
        'checkboxOptions' => function ($model, $key, $index, $column) {
            return ['checked' => false];
        },
        'width' => '20px',
    ],
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
        'attribute' => 'mata_pelajaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tingkat_kelas.tingkat_kelas',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jurusan.jurusan',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Lihat Guru',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                return Html::a('Lihat Guru', ['guru-mata-pelajaran/index', 'id' => $model->id], [
                    'class' => 'btn btn-success btn-info',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip',
                    'target' => '_blank'
                ]);

                // if ($model->id_user) {
                //     return Html::a('Lihat Guru', ['lihat-guru'], [
                //         'class' => 'btn btn-success btn-info',
                //         'role' => 'modal-remote',
                //         'title' => 'Lihat',
                //         'data-toggle' => 'tooltip'
                //     ]);
                // } else {
                //     return Html::a('Lihat Guru', ['buat-akun'], [
                //         'class' => 'btn btn-success btn-block',
                //         'role' => 'modal-remote',
                //         'title' => 'Lihat',
                //         'data-toggle' => 'tooltip'
                //     ]);
                // }
            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'Lihat', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Ubah', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => 'Hapus',
            'data-confirm' => false,
            'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Peringatan',
            'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
        ],
    ],

];
