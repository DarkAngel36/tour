<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\markdown\MarkdownEditor;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */
/* @var $form yii\widgets\ActiveForm */
$tmp_id = $model->isNewRecord ? Yii::$app->session->getId() : $model->id;
$initialPreviewArr = [
    'main' => $model->isNewRecord ? $model->getImagesPreviewArr('main') : ['initialPreview'=>[], 'initialPreviewCfg'=>[]],
    'gallery' => $model->isNewRecord ? $model->getImagesPreviewArr('gallery') : ['initialPreview'=>[], 'initialPreviewCfg'=>[]],
];
//die(print_r($initialPreviewArr));
?>

<div class="tours-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
//        'enableClientValidation' => true,
//        'enableAjaxValidation' => true
    ]); ?>

    <input type="hidden" name="tmp_id" value="<?= $tmp_id?>">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->widget(Select2::classname(), [
        'data' => \common\models\Cities::getCitiesFrom(),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите город...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'citiesFrom')->widget(Select2::classname(), [
        'data' => \common\models\Cities::getCitiesTo(),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите город/города...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]) ?>

    <?= $form->field($model, 'info')->widget(
        MarkdownEditor::classname(),
        ['height' => 200, 'encodeLabels' => false]
    ) ?>

    <?= $form->field($model, 'options')->widget(
        MarkdownEditor::classname(),
        ['height' => 200, 'encodeLabels' => false]
    ) ?>

    <?= $form->field($model, 'programm')->widget(
        MarkdownEditor::classname(),
        ['height' => 300, 'encodeLabels' => false]
    ) ?>

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
            'initialPreview' => $initialPreviewArr['main']['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArr['main']['initialPreviewCfg'],
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
            'initialPreview' => $initialPreviewArr['gallery']['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArr['gallery']['initialPreviewCfg'],
        ]
    ]);?>

    <?= $form->field($model, 'show_main')->widget(Select2::classname(), [
        'data' => [0 => 'Нет', 1 => 'Да'],
        'language' => 'ru',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

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
