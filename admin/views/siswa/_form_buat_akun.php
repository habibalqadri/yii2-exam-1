<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
// use kartikorm\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($dataUser, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($dataUser, 'email') ?>

    <?= $form->field($dataUser, 'password')->passwordInput() ?>

    <!-- Reapeat Password -->
    <?= $form->field($dataUser, 'repeat_password')->passwordInput()
    ?>









    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($dataUser->isNewRecord ? 'buat-akun' : 'Update', ['class' => $dataUser->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>