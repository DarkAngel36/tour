<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 17.03.2019
 * Time: 18:12
 */

namespace frontend\widgets\cities;
use common\models\Pages;
use yii\base\Widget;

class PageWidget extends Widget
{
    public $code = 'about';

    public function run()
    {
        return $this->render('@frontend/widgets/cities/views/index/text-block',[
            'item' => Pages::find()/*->where(['code' => $this->code])*/->one()
        ]);
    }
}