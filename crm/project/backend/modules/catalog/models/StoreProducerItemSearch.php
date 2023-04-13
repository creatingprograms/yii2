<?php

namespace backend\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\StoreProducerItem;

/**
 * StoreProducerItemSearch represents the model behind the search form of `backend\models\StoreProducerItem`.
 */
class StoreProducerItemSearch extends StoreProducerItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'producer_id', 'type'], 'integer'],
            [['title', 'anons', 'slug', 'imageFile', 'description'], 'safe'],
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
        $query = StoreProducerItem::find();

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
            'producer_id' => $this->producer_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'anons', $this->anons])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'imageFile', $this->imageFile])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
