<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = 'Добавить отель';
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
