<?php

namespace backend\modules\forum\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\forum\models\InfoblockItem;

/**
 * InfoblockItemSearch represents the model behind the search form of `backend\models\InfoblockItem`.
 */
class InfoblockItemSearch extends InfoblockItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'infoblock_id'], 'integer'],
            [['title', 'anons', 'imageFile', 'allFile', 'description'], 'safe'],
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
        $query = InfoblockItem::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'anons', $this->anons])
            ->andFilterWhere(['like', 'imageFile', $this->imageFile])
            ->andFilterWhere(['like', 'allFile', $this->allFile])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
