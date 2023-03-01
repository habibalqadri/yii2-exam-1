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
                'tahun_ajaran.tahun_ajaran',
                'nama_kelas',
                'tingkat_kelas.tingkat_kelas',
                'wali_kelas.nama_guru',
                'jurusan.jurusan',
            ],
        ]) ?>
    </div>

</div>