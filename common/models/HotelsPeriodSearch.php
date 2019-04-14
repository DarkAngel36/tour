<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsPeriod;

/**
 * HotelsPeriodSearch represents the model behind the search form of `common\models\HotelsPeriod`.
 */
class HotelsPeriodSearch extends HotelsPeriod
{
	public $cityTo;
	
	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
	        [['id', 'hotel_id', 'from', 'to', 'status'], 'integer'],
	        [['category', 'cityTo'], 'safe'],
	        [['cost'], 'number'],
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
        $query = HotelsPeriod::find();

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
            'hotel_id' => $this->hotel_id,
            'from' => $this->from,
            'to' => $this->to,
            'cost' => $this->cost,
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

        $query->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
