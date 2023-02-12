<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $id
 * @property string|null $nis
 * @property string|null $nama
 * @property string|null $alamat
 * @property int|null $id_kelas
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property int|null $id_user
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['id_kelas', 'id_user'], 'default', 'value' => null],
            [['id_kelas', 'id_user'], 'integer'],
            [['tanggal_lahir'], 'safe'],
            [['nis'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
            [['tempat_lahir'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nis' => 'Nis',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'id_kelas' => 'Id Kelas',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'id_user' => 'Id User',
        ];
    }

    public function getNamaKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
    public function getWaliKelas(){
        return $this->hasOne(Guru::className() , ['id' => 'id']);
    }
    public function getTahunAjaran(){
        return $this->hasOne(RefTahunAjaran::className(), ['id' =>'id']);
    }
    
}
