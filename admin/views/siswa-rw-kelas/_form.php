<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaRwKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-rw-kelas-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'id_siswa')->widget(Select2::classname(), [
        'data' => $dataSiswa,
        'options' => ['placeholder' => '-Nama Siswa-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Siswa'); ?>



    <?= $form->field($model, 'id_kelas')->widget(Select2::classname(), [
        'data' => $dataKelas,
        'options' => ['placeholder' => '-Nama Kelas-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Kelas'); ?>



    <?= $form->field($model, 'id_tahun_ajaran')->widget(Select2::classname(), [
        'data' => $dataTahunAjaran,
        'options' => ['placeholder' => '-Tahun Ajaran-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tahun Ajaran'); ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>


    <?php
    echo $form->field($model, 'id_tingkat')
        ->dropDownList(
            $dataTingkat,
            ['id_tingkat' => 'tingkat_kelas']
        );
    ?>



    <?= $form->field($model, 'id_wali_kelas')->widget(Select2::classname(), [
        'data' => $dataGuru,
        'options' => ['placeholder' => '-Wali Kelas-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Wali Kelas'); ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>