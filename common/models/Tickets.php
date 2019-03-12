<?php

namespace common\models;

use Yii;
use klisl\behaviors\JsonBehavior;
/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $city_from_id
 * @property int $city_to_id
 * @property array $dates
 * @property int $status
 *
 * @property Cities $cityFrom
 * @property Cities $cityTo
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    public function behaviors()
    {
        return [
            [
                'class' => JsonBehavior::className(),
                'property' => 'dates',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_from_id', 'city_to_id'], 'required'],
            [['city_from_id', 'city_to_id', 'status'], 'integer'],
            [['dates'], 'safe'],
            [['city_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_from_id' => 'id']],
            [['city_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_to_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_from_id' => 'Откуда',
            'city_to_id' => 'Куда',
            'dates' => 'Даты',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityFrom()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityTo()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_to_id']);
    }
}
