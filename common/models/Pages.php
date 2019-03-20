<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $content
 */
class Pages extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    public $tmp_id, $img_list;

    public static function getSizes()
    {
        return [
            'main' => [
                ['w' => 448, 'h' => 298],
            ],
            'gallery' => [
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['code', 'title'], 'string', 'max' => 255],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['tmp_id', 'img_list', 'img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'img' => 'Главное изображение'
        ];
    }

    public static function getTmpImgPath($add)
    {
        return \Yii::$app->basePath . '/../frontend/web/images/pages/' . (!empty($add) ? $add . '/' : '');
    }
}
