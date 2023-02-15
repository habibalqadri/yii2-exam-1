<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>
<div class="siswa-view">
    <h1>NIS: <?= $dataSiswa->nis ?></h1>

    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Nama</th>
                <th>Status</th>
                <div class="mx-auto">
                    <th>
                        <center>
                            Action
                        </center>
                    </th>
                </div>
            </thead>


            <?php foreach ($model as $model) : ?>
                <tr>
                    <td><?= $model->waliSiswa->nama ?></td>
                    <td><?= $model->waliSiswa->statusWali->status_wali ?></td>
                    <td>
                        <div class="row justify-content-start">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <?=
                                        Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['lihat-detail-wali', 'id' => $model->waliSiswa->id], [

                                            'role' => 'modal-remote',
                                            'title' => 'Lihat',
                                            'data-toggle' => 'tooltip'
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-2">
                                        <?=
                                        Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['ubah-wali', 'id' => $model->waliSiswa->id], [

                                            'role' => 'modal-remote',
                                            'title' => 'Ubah Wali',
                                            'data-toggle' => 'tooltip'
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-2">
                                        <?=
                                        Html::a('<i class="glyphicon glyphicon-trash"></i>', ['hapus-wali', 'id' => $model->waliSiswa->id], [

                                            'role' => 'modal-remote',
                                            'title' => 'Hapus Wali',
                                            'data-toggle' => 'tooltip'

                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

</div>