<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
    // [
    //     // 'class'=>'\kartik\grid\DataColumn',
    //     // 'header' => 'ID Siswa',
    //     // 'template'=>'{id_siswa}',
    //     // 'button' => [
    //     //     "id_siswa" => function ($url,$model,$key){
    //     //         return Html::a('Lihat ID' , ['id-siswa', 'id' => $model->id, 'id_siswa' => $model->$id], [
    //     //             'class' => 'btn btn-success btn-block',
    //     //             'role' => 'modal-remote',
    //     //             'title' => 'Lihat',
    //     //             'data-toggle' => 'tooltip',
    //     //         ]);
         
    //     //    }, 
    //     // ]
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_kelas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_tahun_ajaran',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_tingkat',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_wali_kelas',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Peringatan',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    ],

];   