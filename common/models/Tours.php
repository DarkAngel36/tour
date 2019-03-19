<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\imagine\Image;
/**
 * This is the model class for table "tours".
 *
 * @property int $id
 * @property string $name
 * @property string $info
 * @property int $city_id
 * @property array $options
 * @property string $programm
 * @property string $img
 * @property [] $img_list
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CitiesTours[] $citiesTours
 * @property Cities[] $cities
 * @property TourLists[] $tourLists
 * @property int $show_main
 */
class Tours extends BaseModel
{
    /**
     * Города
     */
    public $citiesFrom = [];

    public $tmp_id;

    public static function getSizes()
    {
        return [
            'main' => [
                ['w' => 468, 'h' => 331],
                ['w' => 448, 'h' => 298],
                ['w' => 368, 'h' => 273]
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
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['info', 'programm','options'], 'string'],
            [['city_id', 'status', 'created_at', 'updated_at', 'show_main'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['citiesFrom', 'img', 'img_list', 'tmp_id'], 'safe'],
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
            'info' => 'Общая информация',
            'city_id' => 'Куда',
            'citiesFrom' => 'Откуда',
            'options' => 'Опции',
            'programm' => 'Программа',
            'img' => 'Главное изображение',
            'img_list' => 'Галлерея',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'show_main' => 'Показывать на главной'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitiesFrom()
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

    public function beforeSave($insert)
    {
        if(!is_array($this->img_list)) {
            $tmp = explode(',', $this->img_list);
            foreach ($tmp as $key=>$value) {
                if(empty($value)) unset($tmp[$key]);
            }
            $this->img_list = $tmp;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $sql = "DELETE from {{%cities_tours}} WHERE tours_id = {$this->id};";
        Yii::$app->getDb()->createCommand($sql)->execute();
        $sql = '';
        foreach($this->citiesFrom as $cityId) {
            $sql .= "INSERT INTO {{%cities_tours}} (cities_id, tours_id) VALUES ({$cityId}, {$this->id}); ";
        }
        Yii::$app->getDb()->createCommand($sql)->execute();
        // apply image
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        $citiesArr = Yii::$app->db->createCommand("SELECT cities_id FROM {{%cities_tours}} WHERE tours_id = {$this->id}")->queryAll();
        $this->citiesFrom = ArrayHelper::getColumn($citiesArr, 'cities_id');

        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public static function getTmpImgPath($add)
    {
        return \Yii::$app->basePath . '/../frontend/web/images/tours/' . (!empty($add) ? $add . '/' : '');
    }

}
