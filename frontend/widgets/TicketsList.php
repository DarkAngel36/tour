<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 17.03.2019
 * Time: 17:17
 */

namespace frontend\widgets;
use common\models\Tickets;
use yii\base\Widget;

class TicketsList extends Widget
{
    public function run()
    {
        return $this->render('@frontend/widgets/cities/views/index/list/tickets',[
            'items' => Tickets::find()->where('status = 1')->all()
        ]);
    }
}