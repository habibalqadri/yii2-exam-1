<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $id
 * @property string|null $nis
 * @property string|null $nama
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $alamat
 * @property int|null $id_kelas
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
            [['tanggal_lahir'], 'safe'],
            [['alamat'], 'string'],
            [['id_kelas'], 'default', 'value' => null],
            [['id_kelas'], 'integer'],
            [['nis'], 'string', 'max' => 10],
            [['nama', 'tempat_lahir'], 'string', 'max' => 255],
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
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'id_kelas' => 'Nama Kelas',
            'akun.username' => 'Username',
            'akun.email' => 'Email'
        ];
    }

    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
    public function getAkun()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    // public function saveRiwayat()
    // {
    //     $modelKelas = Kelas::find()->where(['id_kelas' => $this->id])->one();
    //     $SiswaRwKelas = new SiswaRwKelas();
    //     $SiswaRwKelas->id_siswa = $this->id;
    //     $SiswaRwKelas->id_kelas = null;
    //     $SiswaRwKelas->id_tahun_ajaran = $modelKelas->id_tahun_ajaran;
    //     $SiswaRwKelas->nama_kelas = $modelKelas->nama_kelas;
    //     $SiswaRwKelas->id_tingkat = $modelKelas->id_tingkat;
    //     $SiswaRwKelas->id_wali_kelas = $modelKelas->id_wali_kelas;
    //     $SiswaRwKelas->save();
    // }
}
