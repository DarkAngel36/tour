<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 22.02.2019
 * Time: 11:27
 */

namespace frontend\widgets\cities;

use common\models\Tours;
use frontend\models\Cities;
use yii\base\Widget;
use yii\helpers\Html;

class IndexListRail extends Widget
{
    public function run()
    {
        $cities = Cities::find()->where('direction = 2 AND status = 1')->all();
        return $this->render('@frontend/widgets/cities/views/index/list/rail',[
            'cities' => $cities,
            'tours' => Tours::find()->where('show_main = 1')->all()
        ]);
    }
}