<?php

namespace backend\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\StoreSettings;

/**
 * StoreSettingsSearch represents the model behind the search form of `backend\models\StoreSettings`.
 */
class StoreSettingsSearch extends StoreSettings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type'], 'integer'],
            [['module_id', 'param_name', 'param_value', 'create_time', 'update_time'], 'safe'],
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
        $query = StoreSettings::find();

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
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'user_id' => $this->user_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'module_id', $this->module_id])
            ->andFilterWhere(['like', 'param_name', $this->param_name])
            ->andFilterWhere(['like', 'param_value', $this->param_value]);

        return $dataProvider;
    }
}
