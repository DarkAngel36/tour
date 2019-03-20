<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    var arDates = <?= json_encode($model->dates)?>;
</script>
<div class="tickets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city_from_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'name') ,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите город...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'city_to_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите город...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <label class="control-label" for="tickets-dates">Даты</label>

        <?= DatePicker::widget([
            'name' => 'adding_date',
            'value' => date('d.m.Y'),
            'options' => ['placeholder' => 'Select issue date ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true
            ]
        ])?>
        <?= Html::a('Добавить', '#', ['id' => 'btnAdd'])?>
        <div class="list-dates"></div>
    </div>


    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => [ 0 => 'Неактивен', 1 => 'Активен'],
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

<?php
$js1 = <<<JS
function renderDates(){
    arDates.sort();
    var html='';
    for(k in arDates) {
        html += "<p>"+arDates[k]+"<input type='hidden' name='Tickets[dates][]' value='"+arDates[k]+"'><a href='#' class='deleteDate' attr-indx='"+k+"'><i class='glyphicon glyphicon-remove kv-dp-icon'></i></a></p>";
    }
    $('.list-dates').html(html);
}
function deleteDate(index){
    if (index !== -1) arDates.splice(index, 1);
    renderDates();
}
$(document).ready(function(){
        renderDates();
        $('#btnAdd').on('click', function (e) {
            e.preventDefault();
            var index = arDates.indexOf($('input[name="adding_date"]').val());
            if (index == -1) {
                arDates.push($('input[name="adding_date"]').val());
            console.log(arDates)
            renderDates();
            }
            
        })
        $(document).on('click', 'a.deleteDate', function(e) {
            e.preventDefault();
            arDates.splice($(this).attr('attr-indx'), 1);
            console.log([arDates, $(this).attr('attr-indx') ])
            renderDates();
        })
    })
JS;
$this->registerJs($js1);
?>

