<?php

namespace guru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kelas;

/**
 * DaftarKelasSearch represents the model behind the search form about `common\models\Kelas`.
 */
class DaftarKelasSearch extends Kelas
{
    public $tahun_ajaran;
    public $tingkat_kelas;
    public $wali_kelas;
    public $jurusan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'integer'],
            [['nama_kelas', 'tahun_ajaran', 'tingkat_kelas', 'wali_kelas', 'jurusan'], 'safe'],
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
        $query = Kelas::find();
        $query->leftJoin('ref_tahun_ajaran', 'kelas.id_tahun_ajaran=ref_tahun_ajaran.id')
            ->leftJoin('ref_tingkat_kelas', 'kelas.id_tingkat=ref_tingkat_kelas.id')
            ->leftJoin('guru', 'kelas.id_wali_kelas=guru.id')
            ->leftJoin('ref_jurusan', 'kelas.id_jurusan=ref_jurusan.id');

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

        $query->andFilterWhere([
            'id' => $this->id,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_tingkat' => $this->id_tingkat,
            'id_wali_kelas' => $this->id_wali_kelas,
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas])
            ->andFilterWhere(['like', 'ref_tahun_ajaran.tahun_ajaran', $this->tahun_ajaran])
            ->andFilterWhere(['like', 'ref_tingkat_kelas.tingkat_kelas', $this->tingkat_kelas])
            ->andFilterWhere(['like', 'guru.nama_guru', $this->wali_kelas])
            ->andFilterWhere(['like', 'ref_jurusan.jurusan', $this->jurusan]);

        return $dataProvider;
    }
}
