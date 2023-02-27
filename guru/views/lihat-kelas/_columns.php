<?php

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
        'attribute' => 'nama_kelas',
    ],



    [
        'class' => '\kartik\grid\DataColumn',
        'value' => 'tingkat_kelas.tingkat_kelas',
        'attribute' => 'tingkat_kelas',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'value' => 'jurusan.jurusan',
        'attribute' => 'jurusan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        // 'attribute' => 'id_tahun_ajaran',
        'value' => 'tahun_ajaran.tahun_ajaran',
        'attribute' => 'tahun_ajaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => "Wali Kelas",
        'attribute' => 'wali_kelas.nama_guru',
    ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign' => 'middle',
    //     'urlCreator' => function ($action, $model, $key, $index) {
    //         return Url::to([$action, 'id' => $model->id]);
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
