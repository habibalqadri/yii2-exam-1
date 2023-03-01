<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

CrudAsset::register($this);
$this->title = 'Biodata';
?>



<?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']) ?>

<div class="siswa-view">
    <div class="row">
        <div class="col-5 d-none d-lg-block ">
            <div id="ajaxCrudDataTable">
                <div class="table-responsive">
                    <br>
                    <?php Pjax::begin(['id' => 'id-pjax']); ?>
                    <?= DetailView::widget([

                        'model' => $model,
                        'attributes' => [
                            'nis',
                            'nama',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'alamat:ntext',
                            'kelas.nama_kelas',
                        ],
                    ]) ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>

        </div>
        <div class="col-10 d-md-none">
            <div id="ajaxCrudDataTable">
                <div class="table-responsive">
                    <br>
                    <?= DetailView::widget([

                        'model' => $model,
                        'attributes' => [
                            'nis',
                            'nama',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'alamat:ntext',
                            'kelas.nama_kelas',
                        ],
                    ]) ?>
                </div>
            </div>

        </div>
    </div>


</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'options' => [
        'tabindex' => false
    ],
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>