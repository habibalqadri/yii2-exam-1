<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
?>
<div class="siswa-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        // 'kelas' => $kelas,
        'attributes' => [
            'id',
            'nis',
            'nama',
            'alamat:ntext',
            'id_kelas',
            'tempat_lahir',
            'tanggal_lahir',
            'id_user',
            // 'rwKelas.id_siswa',
            // 'rwKelas.id_kelas',
            // 'rwKelas.id_tahun_ajaran',
            // 'rwKelas.nama_kelas',
            // 'rwKelas.id_tingkat',
            // 'rwKelas.id_wali_kelas',
        ],
    ]) ?>
    </div>

</div>
