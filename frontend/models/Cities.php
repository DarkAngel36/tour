<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 22.02.2019
 * Time: 11:43
 */

namespace frontend\models;


use yii\helpers\FileHelper;

class Cities extends \common\models\Cities
{
    public function getImg()
    {
        $path = \Yii::getAlias('@app') . DIRECTORY_SEPARATOR .
            'web'. DIRECTORY_SEPARATOR .
            'images'. DIRECTORY_SEPARATOR .
            'cities' . DIRECTORY_SEPARATOR .
            $this->id . DIRECTORY_SEPARATOR .
            'main';

        if(is_dir($path)) {
            $images = FileHelper::findFiles($path);
            if(!empty($images)) return str_replace(\Yii::getAlias('@app') . DIRECTORY_SEPARATOR .
                'web', '', $images[0]);
        }

        return '';
    }
}