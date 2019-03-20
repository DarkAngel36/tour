<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPeriod */

$this->title = 'Update Hotels Period: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotels Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotels-period-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
