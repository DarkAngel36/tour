<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPeriod */

$this->title = 'Добавить период';
$this->params['breadcrumbs'][] = ['label' => 'Отели', 'url' => ['/hotels']];
$this->params['breadcrumbs'][] = ['label' => 'Периоды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Периоды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
