<?php

namespace backend\modules\forum\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\forum\models\Record;

/**
 * RecordSearch represents the model behind the search form of `backend\models\Record`.
 */
class RecordSearch extends Record
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile', 'title', 'anons', 'description', 'title_file', 'allFile', 'created_at'], 'safe'],
            [['id', 'infoblock_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Record::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'infoblock_id' => $this->infoblock_id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'imageFile', $this->imageFile])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'anons', $this->anons])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'title_file', $this->title_file])
            ->andFilterWhere(['like', 'allFile', $this->allFile]);

        return $dataProvider;
    }
}
