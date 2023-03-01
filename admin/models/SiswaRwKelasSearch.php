<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaRwKelas;

/**
 * SiswaRwKelasSearch represents the model behind the search form about `common\models\SiswaRwKelas`.
 */
class SiswaRwKelasSearch extends SiswaRwKelas
{

    public $nama_siswa;
    public $kelas_related;
    public $tahun_ajaran;
    public $tingkat_kelas;
    public $wali_kelas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas', 'nama_siswa', 'kelas_related', 'tahun_ajaran', 'tingkat_kelas', 'wali_kelas'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SiswaRwKelas::find();

        //kode dibawah untuk pemakaian leftJoin
        $query->leftJoin('siswa', 'siswa_rw_kelas.id_siswa = siswa.id')
            ->leftJoin('kelas', 'siswa_rw_kelas.id_kelas = kelas.id')
            ->leftJoin('ref_tahun_ajaran', 'siswa_rw_kelas.id_tahun_ajaran = ref_tahun_ajaran.id')
            ->leftJoin('ref_tingkat_kelas', 'siswa_rw_kelas.id_tingkat = ref_tingkat_kelas.id')
            ->leftJoin('guru', 'siswa_rw_kelas.id_wali_kelas = guru.id');
        //di leftjoin kelas nya terkena masalah karena namanya sama dengan nama siswaRwKelasSearch yaitu nama_kelas


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->joinWith('siswa');

        $query->andFilterWhere([
            'id' => $this->id,
            'id_siswa' => $this->id_siswa,
            'id_kelas' => $this->id_kelas,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_tingkat' => $this->id_tingkat,
            'id_wali_kelas' => $this->id_wali_kelas,
        ]);

        //untuk query andFilterWherenya harus dipisah
        $query
            ->andFilterWhere(['like', 'siswa_rw_kelas.nama_kelas', $this->nama_kelas,]) //tambahkan nama tablenya
            ->andFilterWhere(['like', 'siswa.nama', $this->nama_siswa,])
            ->andFilterWhere(['like', 'kelas.nama_kelas', $this->kelas_related,])
            ->andFilterWhere(['like', 'ref_tahun_ajaran.tahun_ajaran', $this->tahun_ajaran,])
            ->andFilterWhere(['like', 'ref_tingkat_kelas.tingkat_kelas', $this->tingkat_kelas,])
            ->andFilterWhere(['like', 'guru.nama_guru', $this->wali_kelas,]);

        return $dataProvider;
    }
}
