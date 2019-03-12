<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */
/* @var $form yii\widgets\ActiveForm */

$tmp_id = $model->isNewRecord ? Yii::$app->session->getId() : $model->id;
$initialPreviewArr = $model->getImagesPreviewArr('main');
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direction')->widget(Select2::classname(), [
        'data' => \common\models\Cities::directionNames(),
        'language' => 'ru',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'img')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginEvents' => [
            "fileuploaded" => "function(event, data, previewId, index) { var name = data.response.fileName; $(\"input[name='Tours[img]'][type='hidden']\").val( name ); return false; }",
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/ajax/file-upload']),
            'deleteUrl' => Url::to(['/ajax/file-delete', [ 'img' => $img->caption]]),
            'uploadExtraData' => [
                'tour_id' => $model->id,
                'source' => $model::className(),
                'tmp_id' => $tmp_id,
                'category' => 'main'
            ],
            'deleteExtraData' => [
                'source_id' => $model->id,
                'source' => $model::className(),
                'category' => 'main'
            ],
            'maxFileCount' => 10,
            'overwriteInitial'=>false,
            'initialPreviewAsData'=>true,
            'initialPreview' => $initialPreviewArr['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArr['initialPreviewCfg'],
        ]
    ]);?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => \common\models\Cities::getStatusesList(),
        'language' => 'ru',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
