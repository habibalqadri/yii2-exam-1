<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaRwKelas */


?>

<div class="siswa-rw-kelas-view">
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'siswa.nama',
                'kelas.nama_kelas',
                'tahun_ajaran.tahun_ajaran',
                'nama_kelas',
                'tingkat.tingkat_kelas',
                'wali_kelas.nama_guru',
            ],
        ]) ?>
    </div>

</div>