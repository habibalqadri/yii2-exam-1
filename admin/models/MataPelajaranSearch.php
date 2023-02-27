<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MataPelajaran;

/**
 * MataPelajaranSearch represents the model behind the search form about `common\models\MataPelajaran`.
 */
class MataPelajaranSearch extends MataPelajaran
{
    public $tingkat_kelas;
    public $jurusan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tingkat_kelas', 'id_jurusan'], 'integer'],
            [['mata_pelajaran', 'tingkat_kelas', 'jurusan'], 'safe'],
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
        $query = MataPelajaran::find();

        $query->leftJoin('ref_tingkat_kelas', 'mata_pelajaran.id_tingkat_kelas = ref_tingkat_kelas.id')
            ->leftJoin('ref_jurusan', 'mata_pelajaran.id_jurusan = ref_jurusan.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_tingkat_kelas' => $this->id_tingkat_kelas,
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'mata_pelajaran', $this->mata_pelajaran])
            ->andFilterWhere(['like', 'ref_tingkat_kelas.tingkat_kelas', $this->tingkat_kelas])
            ->andFilterWhere(['like', 'ref_jurusan.jurusan', $this->jurusan]);

        return $dataProvider;
    }
}
