<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kelas */

?>
<div class="kelas-create">
    <?= $this->render('_form_tahun_ajaran', [
        'dataTahunAjaran' => $dataTahunAjaran,
        'modelTahunAjaran' => $modelTahunAjaran,

    ]) ?>
</div>