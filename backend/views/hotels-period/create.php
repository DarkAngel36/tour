<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPeriod */

$hotel = \common\models\Hotels::findOne($model->hotel_id);

$this->title = 'Добавить период';
$this->params['breadcrumbs'][] = ['label' => 'Отели', 'url' => ['/hotels']];
$this->params['breadcrumbs'][] = ['label' => $hotel->name, 'url' => ['/hotels/view/', 'id' => $model->hotel_id]];
$this->params['breadcrumbs'][] = ['label' => 'Периоды', 'url' => ['index/' . $model->hotel_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
