<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tickets', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'city_from_id',
                'value' => function($model){
                    return $model->cityFrom->name;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'city_from_id',
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Выберите ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'city_to_id',
                'value' => function($model){
                    return $model->cityTo->name;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'city_to_id',
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Выберите ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'dates',
                'value' => function($model){
                    return implode(',', $model->dates);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 1 ? 'Активен' : 'Неактивен';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
