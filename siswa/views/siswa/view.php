<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

CrudAsset::register($this);
$this->title = 'Biodata';
?>
<div id="ajaxCrudDataTable">
    <?php GridView::widget([
        'id' => 'crud-datatable',
        'dataProvider' => $dataProvider,
        'pjax' => true,
    ]) ?>
</div>


<?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote']) ?>

<div class="siswa-view">
    <div class="row">
        <div class="col-5">
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