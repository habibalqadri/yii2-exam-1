<?php

namespace common\components;

use common\models\Guru;
use Yii;
use yii\base\Component;

class PenggunaComponent extends Component
{
    public $web;
    public $adminUrl;

    public function getDataGuru()
    {
        $id_user = Yii::$app->user->identity->id;
        $guru = Guru::find()->where(['id_user' => $id_user])->one();
        return $guru;
    }
}
