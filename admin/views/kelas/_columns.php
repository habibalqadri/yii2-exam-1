<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
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
        // 'attribute' => 'id_tahun_ajaran',
        'attribute' => 'tahun_ajaran.tahun_ajaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama_kelas',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tingkat_kelas.tingkat_kelas',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => "Wali Kelas",
        'attribute' => 'wali_kelas.nama_guru',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jurusan.jurusan',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Action',
        'template' => '{tambah_siswa}',
        'buttons' => [
            "tambah_siswa" => function ($url, $model, $key) {
                return Html::a('+ Siswa', ['tambah-siswa', 'id' => $model->id], [
                    'class' => 'btn btn-warning btn-warning',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Action',
        'template' => '{lihat_siswa}',
        'buttons' => [
            "lihat_siswa" => function ($url, $model, $key) {
                return Html::a('Lihat Siswa', ['siswa/index2', 'id' => $model->id], [
                    'class' => 'btn btn-success btn-success',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);
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
            'role' => 'modal-remote', 'title' => 'Hapus',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Peringatan',
            'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?'
        ],
    ],

];
