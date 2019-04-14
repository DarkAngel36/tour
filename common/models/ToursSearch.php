<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tours;
use yii\helpers\ArrayHelper;

/**
 * ToursSearch represents the model behind the search form of `common\models\Tours`.
 */
class ToursSearch extends Tours
{
    public $cityFrom, $cityTo, $parentsCount, $childCount, $hotel_id, $period;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'info', 'options', 'programm', 'cityFrom', 'cityTo', 'parentsCount', 'childCount', 'hotel_id', 'period'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cityTo' => 'Куда',
            'cityFrom' => 'Откуда',
            'hotel_id' => 'Отель',
            'period' => 'Период тура'
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
        $query = Tours::find();

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
            'city_id' => $this->city_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'programm', $this->programm]);

        return $dataProvider;
    }
}
