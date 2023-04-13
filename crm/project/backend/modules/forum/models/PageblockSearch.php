<?php

namespace backend\modules\forum\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pageblock;

/**
 * PageblockSearch represents the model behind the search form of `backend\models\Pageblock`.
 */
class PageblockSearch extends Pageblock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'infoblock_id', 'staticpage_id'], 'integer'],
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
        $query = Pageblock::find();

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
            'staticpage_id' => $this->staticpage_id,
        ]);

        return $dataProvider;
    }
}
