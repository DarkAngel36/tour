<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = 'Добавить тур';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
