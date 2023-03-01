<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guru".
 *
 * @property int $id
 * @property string|null $nama_guru
 */
class Guru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guru';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_guru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_guru' => 'Nama Guru',
            'akun.username' => 'Username',
            'akun.email' => 'Email'
        ];
    }

    public function getAkun()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    public function cekStatusMapel($id)
    {
        return $this->hasOne(GuruMataPelajaran::className(), ['id_guru' => 'id'])->andOnCondition(['id_mata_pelajaran' => $id])->exists();
    }
    public function cekIdMapel($id)
    {
        return $this->hasOne(GuruMataPelajaran::className(), ['id_guru' => 'id'])->andOnCondition(['id_mata_pelajaran' => $id])->one();
    }

    public function hapusUser($id)
    {
        $modelGuru = Guru::find()->where(['id' => $id])->one();
        $modelUser = User::find()->where(['id' => $modelGuru->id_user])->one();
        $modelAuth = AuthAssignment::find()->where(['user_id' => $modelUser->id])->one();
        $modelAuth->delete();
        $modelUser->delete();
        $this->delete();
    }
}
