<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_period".
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $from
 * @property int $to
 * @property string $category
 * @property double $cost
 * @property int $status
 *
 * @property Hotels $hotel
 */
class HotelsPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels_period';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id', 'from', 'to', 'status'], 'integer'],
            [['cost'], 'required'],
            [['cost'], 'number'],
            [['category'], 'string', 'max' => 255],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotels::className(), 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_id' => 'Hotel ID',
            'from' => 'From',
            'to' => 'To',
            'category' => 'Category',
            'cost' => 'Cost',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotel_id']);
    }
}
