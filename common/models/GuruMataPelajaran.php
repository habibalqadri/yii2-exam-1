<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guru_mata_pelajaran".
 *
 * @property int|null $id_guru
 * @property int|null $id_mata_pelajaran
 */
class GuruMataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guru_mata_pelajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_guru', 'id_mata_pelajaran'], 'default', 'value' => null],
            [['id_guru', 'id_mata_pelajaran'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_guru' => 'Guru',
            'id_mata_pelajaran' => 'Mata Pelajaran',
        ];
    }

    public function getGuru()
    {
        return $this->hasOne(Guru::className(), ['id' => 'id_guru']);
    }
    public function getMata_pelajaran()
    {
        return $this->hasOne(MataPelajaran::className(), ['id' => 'id_mata_pelajaran']);
    }

    // public function saveGuruMapel()
    // {
    //     if ($model = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $this->id, 'id_guru' => $this->id_guru])->one()) {
    //         $this->save();
    //     }
    // }


}
