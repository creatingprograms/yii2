<?php

namespace backend\modules\forum\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\forum\models\Infoblock;

/**
 * InfoblockSearch represents the model behind the search form of `backend\models\Infoblock`.
 */
class InfoblockSearch extends Infoblock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'alias', 'description', 'allFile', 'imageFile', 'type', 'text_link', 'link', 'indexok', 'created_at'], 'safe'],
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
        $query = Infoblock::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'allFile', $this->allFile])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'text_link', $this->text_link])
            ->andFilterWhere(['like', 'indexok', $this->indexok])
            ->andFilterWhere(['like', 'imageFile', $this->imageFile]);

        return $dataProvider;
    }
}
