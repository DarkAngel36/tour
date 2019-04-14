<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Hotels;

/**
 * HotelsSearch represents the model behind the search form of `common\models\Hotels`.
 */
class HotelsSearch extends Hotels
{
	public $cityFrom, $hotel_id, $period;
	
	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
	        [['id', 'city_id', 'status'], 'integer'],
	        [['name', 'description', 'img', 'img_list', 'cityFrom', 'jotel_id', 'period'], 'safe'],
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
        $query = Hotels::find();

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
        ]);
	
	    if (!empty($this->cityTo)) {
		    $ids    = [];
		    $hotels = Hotels::find()->where(['city_id' => $this->cityTo])->select('id')->all();
		    foreach ($hotels as $hotel) {
			    $ids[] = $hotel->id;
		    }
		    $query->andWhere(['in', 'id', $ids]);
	    }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'img_list', $this->img_list]);

        return $dataProvider;
    }
}
