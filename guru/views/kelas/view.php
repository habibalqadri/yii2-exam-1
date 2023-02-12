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
            'id_tingkat',
            'id_wali_kelas',
            'id_tahun_ajaran',
            'id_jurusan',
        ],
    ]) ?>
    </div>

</div>
