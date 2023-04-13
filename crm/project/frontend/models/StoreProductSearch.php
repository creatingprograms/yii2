<?php

namespace backend\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\StoreProduct;

/**
 * StoreProductSearch represents the model behind the search form of `backend\models\StoreProduct`.
 */
class StoreProductSearch extends StoreProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'producer_id', 'type', 'category_id', 'parent_id', 'infoblock_id', 'user_id'], 'integer'],
            [['sku', 'title', 'slug', 'price', 'discount_price', 'discount', 'short_description', 'description', 'status', 'imageFile', 'allFile', 'meta_title', 'meta_keywords', 'meta_description', 'position', 'create_time', 'update_time'], 'safe'],
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
        $query = StoreProduct::find();

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
            'category_id' => $this->category_id,
            'parent_id' => $this->parent_id,
            'infoblock_id' => $this->infoblock_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'discount_price', $this->discount_price])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'imageFile', $this->imageFile])
            ->andFilterWhere(['like', 'allFile', $this->allFile])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'position', $this->position]);

        return $dataProvider;
    }
}
