<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
// use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel siswa\models\SiswaWaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wali Murid';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


// $style = <<<CSS

//  .kv-panel-before .kv-grid-toolbar{
//     display: flex;
//     justify-content: end;
//  } 
//  .kv-panel-before .btn-group .btn-default{
//        color: #212529;
//     background-color: #ffc107;
//     border-color: #ffc107;
//  } 
//  CSS;
// $this->registerCss($style);
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
                            'pager' => [
                                'firstPageLabel' => 'Awal',
                                'lastPageLabel'  => 'Akhir'
                            ],
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
                                // 'heading' => '<i class="glyphicon glyphicon-list"></i> Siswa Walis listing',
                                'before' => Html::a(
                                    'Tambah',
                                    ['wali/create'],
                                    ['role' => 'modal-remote', 'title' => 'Create new Siswa Walis', 'class' => 'btn btn-primary']
                                ),
                                // 'after'=>BulkButtonWidget::widget([
                                //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                //                 ["bulk-delete"] ,
                                //                 [
                                //                     "class"=>"btn btn-danger btn-xs",
                                //                     'role'=>'modal-remote-bulk',
                                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                //                     'data-request-method'=>'post',
                                //                     'data-confirm-title'=>'Are you sure?',
                                //                     'data-confirm-message'=>'Are you sure want to delete this item'
                                //                 ]),
                                //         ]).                        
                                '<div class="clearfix"></div>',
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
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>