<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $direction
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $img
 * @property [] $img_list
 *
 * @property CitiesTours[] $citiesTours
 * @property Tours[] $tours
 */
class Cities extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    public static function getSizes()
    {
        return [
            'main' => [
                ['w' => 268, 'h' => 267],
//                ['w' => 368, 'h' => 273]
            ],
            'gallery' => [
//                ['w' => 168, 'h' => 144]
            ]
        ];
    }

    public static function directionNames()
    {
        return [
            1 => 'Убытие',
            2 => 'Прибытие'
        ];
    }

    public function getDirectionName()
    {
        $dirs = self::directionNames();

        return $dirs[$this->direction];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'direction'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DISABLED]],
            [['img', 'img_list'], 'safe'],
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
            'direction' => 'Выезд/Прибытие',
            'img' => 'Главное изображение',
            'img_list' => 'Галлерея',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitiesTours()
    {
        return $this->hasMany(CitiesTours::className(), ['cities_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tours::className(), ['id' => 'tours_id'])->viaTable('cities_tours', ['cities_id' => 'id']);
    }

    /**
     * @return []
     */
    public static function getCities()
    {
        return ArrayHelper::map(self::find()->where('status = 1')->all(), 'id', 'name');
    }

    /**
     * @return []
     */
    public static function getCitiesFrom()
    {
        return ArrayHelper::map(self::find()->where('status = 1 AND direction = 2')->all(), 'id', 'name');
    }

    /**
     * @return []
     */
    public static function getCitiesTo()
    {
        return ArrayHelper::map(self::find()->where('status = 1 AND direction = 1')->all(), 'id', 'name');
    }

    public static function getTmpImgPath($add)
    {
        return \Yii::$app->basePath . '/../frontend/web/images/cities/' . (!empty($add) ? $add . '/' : '');
    }

    public static function getImgUrl($add)
    {
        return '/images/cities/' . (!empty($add) ? $add . '/' : '');
    }
}
