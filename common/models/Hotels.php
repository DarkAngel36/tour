<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property string $description
 * @property string $img
 * @property array $img_list
 * @property int $status
 *
 * @property HotelsPeriod[] $hotelsPeriods
 */
class Hotels extends BaseModel
{
    public $tmp_id;

    public static function getSizes()
    {
        return [
            'main' => [
                ['w' => 268, 'h' => 216],
                ['w' => 368, 'h' => 276]
            ],
            'gallery' => [
                ['w' => 168, 'h' => 144]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    public function behaviors()
    {
        return [
//            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['img_list', 'tmp_id'], 'safe'],
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'city_id' => 'Город',
            'description' => 'Описание',
            'img' => 'Img',
            'img_list' => 'Img List',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPeriods()
    {
        return $this->hasMany(HotelsPeriod::className(), ['hotel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public static function getTmpImgPath($add)
    {
        return \Yii::$app->basePath . '/../frontend/web/images/hotels/' . (!empty($add) ? $add . '/' : '');
    }

    public static function getImgUrl($add)
    {
        $path = '/images/hotels/' . (!empty($add) ? $add . '/' : '');
        $images = FileHelper::findFiles(Yii::$app->basePath . $path, ['recursive' => false]);

        dir(print_r($images));
    }
}
