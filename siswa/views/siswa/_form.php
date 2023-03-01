<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
// use kartikorm\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput([
        'maxlength' => true,
        'disabled' => true
    ]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy',
        ]
    ]);
    ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>


    <?php
    echo $form->field($model, 'id_kelas')->widget(Select2::classname(), [
        'data' => $dataKelas,
        'options' => [
            'placeholder' => '-Pilih Kelas-',
            'disabled' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Kelas');
    ?>




    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>