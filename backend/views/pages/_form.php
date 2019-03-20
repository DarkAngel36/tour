<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */

$tmp_id = $model->isNewRecord ? Yii::$app->session->getId() : $model->id;
$initialPreviewArr = [
    'main' => $model->isNewRecord ? $model->getImagesPreviewArr('main') : ['initialPreview'=>[], 'initialPreviewCfg'=>[]],
    'gallery' => $model->isNewRecord ? $model->getImagesPreviewArr('gallery') : ['initialPreview'=>[], 'initialPreviewCfg'=>[]],
];
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <input type="hidden" name="tmp_id", value="<?= $tmp_id?>">
    <?= $form->field($model, 'tmp_id')->hiddenInput(['value' => $tmp_id])?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

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
            'maxFileCount' => 1,
            'overwriteInitial'=>false,
            'initialPreviewAsData'=>true,
            'initialPreview' => $initialPreviewArr['main']['initialPreview'],
            'initialPreviewConfig' => $initialPreviewArr['main']['initialPreviewCfg'],
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
