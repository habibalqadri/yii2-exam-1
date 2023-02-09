<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_kelas',
            [
                // 'class' => '\kartik\grid\DataColumn',
                'label' => 'Tingkat Kelas',
                'attribute' => 'id_tingkat',
                'value' => function ($model) {
                    return $model->tingkatKelas->tingkat_kelas;
                }
            ],
            [
                // 'class' => '\kartik\grid\DataColumn',
                'label' => 'Wali Kelas',
                'attribute' => 'id_wali_kelas',
                'value' => function ($model) {
                    return $model->waliKelas->nama_guru;
                }
            ],
        ],
    ]) ?>
    </div>

</div>
