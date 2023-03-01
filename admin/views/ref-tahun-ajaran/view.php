<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefTahunAjaran */
?>
<div class="ref-tahun-ajaran-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun_ajaran',
        ],
    ]) ?>
    </div>

</div>
