<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */

?>
<div class="guru-mata-pelajaran-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataGuru' => $dataGuru,
        'dataMataPelajaran' => $dataMataPelajaran,


    ]) ?>
</div>