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

	<!-- <div id="ajaxCrudDatatable">
		<div id="table-responsive">
			<?= GridView::widget([
				'id' => 'crud-datatable',
				// 'pager' => [
				// 	'class' => LinkPager::class
				// ],
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				// 'dataProvider' => $id,
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
							"btn_aksi" => function ($url, $model, $key) {
								// $id = 37;
								return Html::a('Pilih', ['create', 'id' => '', 'id_guru' => $model->id], [
									'class' => 'btn btn btn-outline-info',
									'role' => 'modal-remote',
									'title' => 'Lihat',
									'data-toggle' => 'tooltip'
								]);
							},

						]
					],
				],
				'striped' => true,
				'condensed' => true,
				'responsive' => true,

			]) ?>
		</div>
	</div> -->

	<div class="row justify-content-center">
		<div class="col-11">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Guru</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php Pjax::begin(['id' => 'crud-datatable-pjax']);

					?>

					<?php $no = 1; ?>
					<?php if ($dataGuru) : { ?>
							<?php foreach ($dataGuru as $dataGuru) : {
							?>
									<tr>
										<th scope="row"><?= $no++; ?></th>


										<td><?= $dataGuru->nama_guru ?></td>


										<td>

											<?php
											if ($modelMataPelajaran) {

												echo
												Html::a(
													'Pilih',
													['create', 'id' => $id, 'id_guru' => $dataGuru->id],
													// ['create', 'id' => $id],
													['role' => 'modal-remote', 'title' => 'Create new Guru Mata Pelajarans', 'class' => 'btn btn-outline-info w-75']
												);
											} else {

												echo
												Html::a(
													'Pilih',
													['create', 'id' => $id, 'id_guru' => $dataGuru->id],
													// ['create', 'id' => $id],
													['role' => 'modal-remote', 'title' => 'Create new Guru Mata Pelajarans', 'class' => 'btn btn-outline-info w-75']
												);
											}

											?>
										</td>
									</tr>
							<?php }
							endforeach; ?>

					<?php }
					endif; ?>

					<?php Pjax::end();
					?>
				</tbody>
			</table>
		</div>
	</div>



	<?php if (!Yii::$app->request->isAjax) { ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>