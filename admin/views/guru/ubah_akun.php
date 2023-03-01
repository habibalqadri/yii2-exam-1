<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
?>
<div class="siswa-update">

    <?= $this->render('_form_ubah_akun', [
        'dataUser' => $dataUser,
        'model' => $model,

    ]) ?>

</div>