<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\HotelsPeriodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$hotel = \common\models\Hotels::findOne($hotel_id);

$this->title = 'Отели: периоды';
$this->params['breadcrumbs'][] = ['label' => 'Отели', 'url' => ['/hotels']];
$this->params['breadcrumbs'][] = ['label' => $hotel->name, 'url' => ['/hotels/view/', 'id' => $hotel_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-period-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить период', \yii\helpers\Url::toRoute(['create', 'hotel_id' => $hotel_id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hotel_id',
            'from',
            'to',
            'category',
            //'cost',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
