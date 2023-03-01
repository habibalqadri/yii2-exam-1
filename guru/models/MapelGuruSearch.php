<?php

namespace guru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GuruMataPelajaran;

/**
 * MapelGuruSearch represents the model behind the search form about `common\models\GuruMataPelajaran`.
 */
class MapelGuruSearch extends GuruMataPelajaran
{
    public $mata_pelajaran;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_guru', 'id_mata_pelajaran'], 'integer'],
            [['mata_pelajaran'], 'safe'],
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
        $query = GuruMataPelajaran::find();
        $query->leftJoin('mata_pelajaran', 'guru_mata_pelajaran.id_mata_pelajaran = mata_pelajaran.id');

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
            'id_guru' => $this->id_guru,
            'id_mata_pelajaran' => $this->id_mata_pelajaran,
        ]);


        $query->andFilterWhere(['like', 'mata_pelajaran.mata_pelajaran', $this->mata_pelajaran]);
        return $dataProvider;
    }
}
