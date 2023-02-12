<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">
    <h4> Data Siswa</h4>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

  
</div>

<div class="siswa-rw-kelas-form">
    <h4>Data Kelas</h4>

    <?= $form->field($kelas, 'id_siswa')->textInput() ?>

    <?= $form->field($kelas, 'id_kelas')->textInput() ?>

    <?= $form->field($kelas, 'tahun_ajaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($kelas, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($kelas, 'id_tingkat')->textInput() ?>

    <?= $form->field($kelas, 'id_wali_kelas')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord && $kelas->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord && $kelas->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
