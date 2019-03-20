<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\markdown\MarkdownEditor;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */
/* @var $form yii\widgets\ActiveForm */

$tmp_id = $model->isNewRecord ? Yii::$app->session->getId() : $model->id;
$initialPreviewArrM = $model->getImagesPreviewArr('main');
$initialPreviewArrG = $model->getImagesPreviewArr('gallery');
?>

<div class="hotels-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" name="tmp_id" value="<?= $tmp_id?>">

    <?= $form->field($model, 'tmp_id')->hiddenInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->widget(Select2::classname(), [
        'data' => \common\models\Cities::getCitiesTo(),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите город...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginEvents' => [
            "fileuploaded" => "function(event, data, previewId, index) { var name = data.response.fileName; $(\"input[name='Tours[img]'][type='hidden']\").val( name ); return false; }",
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/ajax/file-upload']),
            'uploadExtraData' => [
                'tour_id' => $model->id,
                'source' => $model::className(),
                'tmp_id' => $tmp_id,
                'category' => 'main'
            ],
            'deleteUrl' => Url::to(['/ajax/file-delete', [ 'img' => '']]),
            'deleteExtraData' => [
                'source_id' => $model->id,
                'source' => $model::className(),
                'category' => 'main'
            ],
            'maxFileCount' => 10,
            'overwriteInitial'=>false,
            'initialPreviewAsData'=>true,
            'initialPreview' => $initialPreviewArrM['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArrM['initialPreviewCfg'],
        ]
    ]);?>
    <?= $form->field($model, 'img_list')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*', 'multiple' => true,],
        'pluginEvents' => [
            "fileuploaded" => "function(event, data, previewId, index) { var name = data.response.fileName; $(\"input[name='Tours[img_list]'][type='hidden']\").val( $(\"input[name='Tours[img_list]'][type='hidden']\").val() + ',' + name ); return false; }",
        ],
        'pluginOptions' => [
            'multiple' => true,
            'uploadUrl' => Url::to(['/ajax/files-upload']),
            'deleteUrl' => Url::to(['/ajax/file-delete', [ 'img' => '']]),
            'uploadExtraData' => [
                'tour_id' => $model->id,
                'source' => $model::className(),
                'tmp_id' => $tmp_id,
                'category' => 'gallery'
            ],
            'deleteExtraData' => [
                'source_id' => $model->id,
                'source' => $model::className(),
                'category' => 'gallery'
            ],
            'maxFileCount' => 10,
            'overwriteInitial'=>false,
            'initialPreviewAsData'=>true,
            'initialPreview' => $initialPreviewArrG['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArrG['initialPreviewCfg'],
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
