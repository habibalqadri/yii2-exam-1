<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaWali */
?>
<div class="siswa-wali-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_siswa',
            'id_wali',
        ],
    ]) ?>
    </div>

</div>
