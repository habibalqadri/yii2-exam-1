<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row justify-content-end">
        <div class="col-12">

        </div>
    </div>

    <?php if ($dataSiswa) { ?>

        <?php echo $form->field($model, 'id_kelas')->widget(Select2::classname(), [
            'data' => $dataSiswa,
            'options' => ['placeholder' => 'Siswa'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])->label('Tambah Siswa');
        ?>

    <?php } else { ?>
        <?php
        echo '<center>- Tidak Ada Data Siswa Yang Ditemukan -</center>'; ?>
    <?php }  ?>


    <?php ActiveForm::end(); ?>

</div>