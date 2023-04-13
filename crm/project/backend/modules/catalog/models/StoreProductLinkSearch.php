<?php

namespace backend\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\StoreProductLink;

/**
 * StoreProductLinkSearch represents the model behind the search form of `backend\models\StoreProductLink`.
 */
class StoreProductLinkSearch extends StoreProductLink
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'linked_product_id'], 'integer'],
            [['type', 'position'], 'safe'],
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
        $query = StoreProductLink::find();

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
            'product_id' => $this->product_id,
            'linked_product_id' => $this->linked_product_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'position', $this->position]);

        return $dataProvider;
    }
}
