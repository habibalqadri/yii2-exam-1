<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */
?>
<div class="guru-mata-pelajaran-view">
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'guru.nama_guru',
                'mata_pelajaran.mata_pelajaran',
            ],
        ]) ?>
    </div>

</div>