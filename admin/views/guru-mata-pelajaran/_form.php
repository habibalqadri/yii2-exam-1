<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-mata-pelajaran-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php
	echo $form->field($model, 'id_guru')
		->dropDownList(
			$dataGuru,
			['id_guru' => 'nama_guru']
		);
	?>

	<?php
	echo $form->field($model, 'id_mata_pelajaran')
		->dropDownList(
			$dataMataPelajaran,
			['id_mata_pelajaran' => 'mata_pelajaran']
		);
	?>


	<?php if (!Yii::$app->request->isAjax) { ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>