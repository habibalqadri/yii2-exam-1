<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_rw_kelas".
 *
 * @property int $id
 * @property int|null $id_siswa
 * @property int|null $id_kelas
 * @property int|null $id_tahun_ajaran
 * @property string|null $nama_kelas
 * @property int|null $id_tingkat
 * @property int|null $id_wali_kelas
 */
class SiswaRwKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa_rw_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'default', 'value' => null],
            [['id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_siswa' => 'Id Siswa',
            'id_kelas' => 'Id Kelas',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'nama_kelas' => 'Nama Kelas',
            'id_tingkat' => 'Id Tingkat',
            'id_wali_kelas' => 'Id Wali Kelas',
            'kelas_related' => 'Kelas',
            'wali_kelas.nama_guru' => 'Wali Kelas'
        ];
    }

    public function getSiswa()
    {
        return $this->hasOne(Siswa::className(), ['id' => 'id_siswa']);
    }
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
    public function getTahun_ajaran()
    {
        return $this->hasOne(RefTahunAjaran::className(), ['id' => 'id_tahun_ajaran']);
    }
    public function getTingkat()
    {
        return $this->hasOne(RefTingkatKelas::className(), ['id' => 'id_tingkat']);
    }
    public function getWali_kelas()
    {
        return $this->hasOne(Guru::className(), ['id' => 'id_wali_kelas']);
    }
}
