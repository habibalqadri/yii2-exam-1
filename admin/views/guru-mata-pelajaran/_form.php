<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-mata-pelajaran-form">

	<h5>Pelajaran : <?= $dataMataPelajaran->mata_pelajaran ?></h5>
	<!-- <h5>Pelajaran : <?= $id ?></h5> -->
	<?php
	// foreach ($modelGuru as $modelGuru) {
	// 	echo $modelGuru->id;
	// }
	?>
	<hr>

	<?php $form = ActiveForm::begin(); ?>

	<div id="ajaxCrudDatatable">
		<div id="table-responsive">

			<?= GridView::widget([
				'id' => 'crud-datatable',
				// 'pager' => [
				// 	'class' => LinkPager::class
				// ],
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'pjax' => true,
				'columns' => [
					[
						'class' => '\kartik\grid\DataColumn',
						'attribute' => 'nama_guru',
					],
					[
						'class' => 'kartik\grid\ActionColumn',
						'header' => 'Akun',
						'template' => '{btn_aksi}',
						'buttons' => [
							"btn_aksi" => function ($url, $model, $key) use ($id) {

								// return $model->cekStatusMapel($id);


								if ($model->cekStatusMapel($id)) {
									return Html::a('Terpilih', ['guru-mata-pelajaran/delete', 'id' => $id, 'id_guru_mapel' => $model->cekIdMapel($id)->id], [
										'class' => 'btn btn btn-info',
										'role' => 'modal-remote',
										'title' => 'Lihat',
										'data-confirm' => false, 'data-method' => false, // for overide yii data api
										'data-request-method' => 'post',
										'data-toggle' => 'tooltip'
									]);
								} else {
									return Html::a('Pilih', ['create', 'id' => $id, 'id_guru' => $model->id], [
										'class' => 'btn btn btn-outline-info',
										'role' => 'modal-remote',
										'title' => 'Lihat',
										'data-toggle' => 'tooltip'
									]);
								}
							},

						]
					],
				],
				'striped' => true,
				'condensed' => true,
				'responsive' => true,

			]) ?>

		</div>
	</div>





	<?php if (!Yii::$app->request->isAjax) { ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>