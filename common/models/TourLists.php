<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_lists".
 *
 * @property int $id
 * @property int $tour_id
 * @property int $date_from
 * @property int $date_to
 * @property int $category
 * @property double $cost
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Tours $tour
 */
class TourLists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'date_from', 'date_to', 'category', 'cost', 'created_at', 'updated_at'], 'required'],
            [['tour_id', 'date_from', 'date_to', 'category', 'status', 'created_at', 'updated_at'], 'integer'],
            [['cost'], 'number'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_id' => 'Tour ID',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'category' => 'Category',
            'cost' => 'Cost',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }
}
