<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'id_tahun_ajaran')
        ->dropDownList(
            $dataTahunAjaran,
            ['id_tahun_ajaran' => 'tahun_ajaran']
        );
    ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'id_tingkat')
        ->dropDownList(
            $dataTingkatKelas,
            ['id_tingkat' => 'tingkat_kelas']
        );
    ?>

    <?php
    echo $form->field($model, 'id_wali_kelas')
        ->dropDownList(
            $dataWaliKelas,
            ['id_wali_kelas' => 'nama_guru']
        );
    ?>


    <?php
    echo $form->field($model, 'id_jurusan')
        ->dropDownList(
            $dataJurusan,
            ['id_jurusan' => 'jurusan']
        );
    ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>