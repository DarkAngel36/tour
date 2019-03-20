<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property int $id
 * @property string $name
 * @property string $info
 * @property int $city_id
 * @property array $options
 * @property string $programm
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CitiesTours[] $citiesTours
 * @property Cities[] $cities
 * @property TourLists[] $tourLists
 * @property Cities $city
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id', 'created_at', 'updated_at'], 'required'],
            [['info', 'programm'], 'string'],
            [['city_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['options'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'info' => 'Info',
            'city_id' => 'City ID',
            'options' => 'Options',
            'programm' => 'Programm',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitiesTours()
    {
        return $this->hasMany(CitiesTours::className(), ['tours_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['id' => 'cities_id'])->viaTable('cities_tours', ['tours_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourLists()
    {
        return $this->hasMany(TourLists::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
