<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
?>
<div class="siswa-view">
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nis',
                'nama',
                [
                    'header' => 'Username',
                    'attribute' => 'akun.username'
                ]
            ],
        ]) ?>
    </div>

</div>