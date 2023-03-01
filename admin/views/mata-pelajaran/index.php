<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\form\ActiveForm;
use yii\bootstrap4\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\MataPelajaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mata Pelajarans';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<!-- <div class="element-wrapper">
    <h6 class="element-header">
            </h6>
    <div class="element-box"> -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="ajaxCrudDatatable">
                    <div id="table-responsive">

                        <?= GridView::widget([
                            'id' => 'crud-datatable',

                            // 'pager' => [
                            //     'class' => LinkPager::class
                            // ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax' => true,
                            'columns' => require(__DIR__ . '/_columns.php'),
                            'toolbar' => [
                                [
                                    'content' =>
                                    Html::a(
                                        '<i class="fas fa-redo"></i> ',
                                        [''],
                                        ['data-pjax' => 1, 'class' => 'btn btn-info', 'title' => 'Reset Grid']
                                    ) .
                                        '{toggleData}'
                                    // .'{export}'
                                ],
                            ],
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'panel' => [
                                // 'type' => 'primary', 
                                // 'heading' => '<i class="glyphicon glyphicon-list"></i> Mata Pelajarans listing',
                                'before' => Html::a(
                                    '+ Tambah',
                                    ['create'],
                                    [
                                        'role' => 'modal-remote',
                                        'title' => 'Create new Mata Pelajarans',
                                        'class' => 'btn btn-warning'
                                    ]
                                ),
                                // 'after' => BulkButtonWidget::widget([
                                //     'buttons' => Html::a(
                                //         '<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                //         ["bulk-delete"],
                                //         [
                                //             "class" => "btn btn-danger btn-xs",
                                //             'role' => 'modal-remote-bulk',
                                //             'data-confirm' => false, 'data-method' => 'post', // for overide yii data api
                                //             'data-request-method' => 'post',
                                //             'data-confirm-title' => 'Are you sure?',
                                //             'data-confirm-message' => 'Are you sure want to delete this item'
                                //         ]
                                //     ),
                                // ])

                                // 'after' =>
                                // Html::a(
                                //     '<i class="glyphicon glyphicon-trash"></i>&nbsp;Delete',
                                //     ["bulk-delete"],
                                //     [
                                //         'role' => 'modal-remote',
                                //         "class" => "btn btn-danger btn-xs",
                                //         'data-toggle' => 'tooltip',
                                //         'data-confirm-title' => 'Peringatan',
                                //         'data-confirm-message' => 'Apakah anda yakin ingin menghapus data ini?',
                                //         'data-confirm' => false,
                                //         'data-method' => 'post', // for overide yii data api
                                //         'data-request-method' => 'post',


                                //     ]
                                // ) .
                                //     '<div class="clearfix"></div>',



                            ]
                        ]) ?>

                    </div>
                </div>
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