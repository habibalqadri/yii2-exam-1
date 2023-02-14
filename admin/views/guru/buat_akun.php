<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

?>
<div class="siswa-create">
    <?= $this->render('_form_buat_akun', [
        // 'model' => $model,
        'dataUser' => $dataUser,

    ]) ?>
</div>