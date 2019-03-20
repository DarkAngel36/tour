<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tickets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Билеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'city_from_id',
                'value' => $model->cityFrom->name
            ],
            [
                'attribute' => 'city_to_id',
                'value' => $model->cityTo->name
            ],
            [
                'attribute' => 'dates',
                'value' => implode('<br>', $model->dates),
                'format' => 'html'
            ],
            [
                'attribute' => 'status',
                'value' => $model->status == 1 ? 'Активен' : 'Неактивен'
            ],
        ],
    ]) ?>

</div>
