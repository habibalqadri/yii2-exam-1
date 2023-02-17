<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-10">
            <div class="row">
                <div class="col-10">
                    <?= $form->field($dataTahunAjaran, 'tahun_ajaran')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-2">
                    <br>
                    <?php Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"]) ?>
                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-10">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun Ajaran</th>

                        <th scope="col">
                            <center>
                                Action
                            </center>
                        </th>
                    </tr>
                </thead>
                <tbody>


                    <?php $i = 1 ?>
                    <?php foreach ($modelTahunAjaran as $value) : ?>

                        <tr>
                            <th scope="row">
                                <?= $i++ ?>
                            </th>
                            <td><?= $value->tahun_ajaran ?></td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col-4 mx-auto">
                                        <?=
                                        Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['lihat-detail-wali'], [

                                            'role' => 'modal-remote',
                                            'title' => 'Lihat',
                                            'data-toggle' => 'tooltip'
                                        ]);
                                        ?>
                                        <?=
                                        Html::a('<i class="glyphicon glyphicon-trash"></i>', ['lihat-detail-wali'], [

                                            'role' => 'modal-remote',
                                            'title' => 'Lihat',
                                            'data-toggle' => 'tooltip'
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($dataTahunAjaran->isNewRecord ? 'Create' : 'Update', ['class' => $dataTahunAjaran->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>