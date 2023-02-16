<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-mata-pelajaran-form">

	<?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'id_guru')->widget(Select2::classname(), [
		'data' => $dataGuru,
		'options' => ['placeholder' => '-Nama Guru-'],
		'pluginOptions' => [
			'allowClear' => true
		],
	])->label('Nama Guru'); ?>

	<?= $form->field($model, 'id_mata_pelajaran')->widget(Select2::classname(), [
		'data' => $dataMataPelajaran,
		'options' => ['placeholder' => '-Mata Pelajaran-'],
		'pluginOptions' => [
			'allowClear' => true
		],
	])->label('Mata Pelajaran'); ?>



	<?php if (!Yii::$app->request->isAjax) { ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>