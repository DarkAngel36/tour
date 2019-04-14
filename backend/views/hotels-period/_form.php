<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPeriod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-period-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_id')->hiddenInput() ?>
	
	<?= $form->field($model, 'from')->widget(DatePicker::classname(), [
	'options' => ['placeholder' => 'С ...'],
	'pluginOptions' => [
	'autoclose'=>true
	]
	]);?>
	
	<?= $form->field($model, 'to')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'По ...'],
		'pluginOptions' => [
			'autoclose'=>true
		]
	]);?>
	
	<?= $form->field($model, 'category')->widget(Select2::classname(), [
		'data'          => ['эконом' => 'эконом', 'стандарт' => 'стандарт', 'люкс' => 'люкс'],
		'language'      => 'ru',
		'options'       => ['prompt' => 'категория номера'],
		'pluginOptions' => [
			'allowClear' => true,
			'prompt' => 'категория номера'
		],
	])->label('Уровень номера') ?>

    <?= $form->field($model, 'cost')->textInput() ?>
	
	<?= $form->field($model, 'status')->widget(Select2::classname(), [
		'data' => \common\models\Cities::getStatusesList(),
		'language' => 'ru',
		'options' => ['prompt' => 'Статус'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
