<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>
<div class="siswa-view">


    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover">
            <tr>
                <th class="w-50">
                    Nama Wali
                </th>
                <td>
                    <?= $modelWali['nama'] ?>
                </td>
            </tr>
            <tr>
                <th class="w-50">
                    Alamat
                </th>
                <td>

                    <?= $modelWali['alamat'] ?>

                </td>
            </tr>
            <tr>
                <th class="w-50">
                    No Hp
                </th>
                <td>

                    <?= $modelWali['no_hp'] ?>

                </td>
            </tr>
            <tr>
                <th class="w-50">
                    Status Wali
                </th>

                <td>
                    <?= $modelWali->statusWali['status_wali'] ?>
                </td>
            </tr>

        </table>
    </div>

</div>