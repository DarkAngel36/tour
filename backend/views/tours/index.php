<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Tours;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ToursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Туры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тур', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            'info:ntext',
            [
                'attribute' => 'city.name',
                'label' => 'Куда'
            ],
            [
                'label' => 'Откуда',
                'format' => 'html',
                'value' => function(Tours $model) {
                    $ret = [];
                    foreach($model->getCitiesFrom()->all() as $city) {
                        $ret[] = $city->name;
                    }
                    return implode('<br>', $ret);
                }
            ],
//            'options',
            //'programm:ntext',
            //'status',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
