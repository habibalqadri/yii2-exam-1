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

    <?= $form->field($model, 'id_tahun_ajaran')->widget(Select2::classname(), [
        'data' => $dataTahunAjaran,
        'options' => ['placeholder' => '-Pilih Tahun Ajaran-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tahun Ajaran'); ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'id_tingkat')
        ->dropDownList(
            $dataTingkatKelas,
            ['id_tingkat' => 'tingkat_kelas']
        );
    ?>


    <?= $form->field($model, 'id_wali_kelas')->widget(Select2::classname(), [
        'data' => $dataWaliKelas,
        'options' => ['placeholder' => '-Pilih Wali Kelas-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Wali Kelas'); ?>


    <?= $form->field($model, 'id_jurusan')->widget(Select2::classname(), [
        'data' => $dataJurusan,
        'options' => ['placeholder' => '-Pilih Jurusan-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jurusan'); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>