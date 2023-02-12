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
        'class'=>'\kartik\grid\DataColumn', 
        'label' => 'ID Siswa',  
        'attribute'=>'id_siswa',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Nama Kelas',
        'attribute'=>'id_kelas',
        'value' => function($model){
            return $model->idKelas->nama_kelas;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Tahun Ajaran',
        'attribute'=>'tahun_ajaran',
        'value' => function($model){
            return $model->tahunAjaran->tahun_ajaran;        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Tingkat',
        'attribute'=>'id_tingkat',
        'value' => function($model){
            return $model->tingkatKelas->tingkat_kelas;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_wali_kelas',
    // ],
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