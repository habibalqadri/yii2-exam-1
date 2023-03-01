<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SiswaRwKelas */

?>
<div class="siswa-rw-kelas-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataSiswa' => $dataSiswa,
        'dataKelas' => $dataKelas,
        'dataTahunAjaran' => $dataTahunAjaran,
        'dataTingkat' => $dataTingkat,
        'dataGuru' => $dataGuru,
    ]) ?>
</div>