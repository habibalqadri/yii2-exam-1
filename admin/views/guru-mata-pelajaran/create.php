<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */

?>
<div class="guru-mata-pelajaran-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataMataPelajaran' => $dataMataPelajaran,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'id' => $id,
        'dataGuru' => $dataGuru,
        'modelMataPelajaran' => $modelMataPelajaran,
        'modelGuru' => $modelGuru,



    ]) ?>
</div>