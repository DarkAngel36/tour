<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
print_r($model->errors);
?>
<!-- - - - - - - - - - - - - - something_container - - - - - - - - - - - - - - - --->
<section class="indent">
    <h2 class="mb40 al_center">Регистрация</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'registration_form']]); ?>

                <?= $form->field($model, 'first_name', [
                        'options' => ['class' => 'form_row'],
                        'labelOptions' => ['class' => 'form_label'],
                        'inputOptions' => ['class' => 'form_input'],
                ]) ?>
                <?= $form->field($model, 'last_name', [
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ]) ?>
                <?= $form->field($model, 'middle_name', [
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ]) ?>
                    <?= $form->field($model, 'email', [
                        'options' => ['class' => 'form_row'],
                        'labelOptions' => ['class' => 'form_label'],
                        'inputOptions' => ['class' => 'form_input'],
                    ]) ?>
                <?= $form->field($model, 'phone', [
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ]) ?>

                <?= $form->field($model, 'password', [
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ])->passwordInput([
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ]) ?>
                <?= $form->field($model, 'repeat_password', [
                    'options' => ['class' => 'form_row'],
                    'labelOptions' => ['class' => 'form_label'],
                    'inputOptions' => ['class' => 'form_input'],
                ])->passwordInput() ?>
                    <div class="form_captcha">
                        <img src="/images/captcha.png" alt="" />
                    </div>
                    <div class="form_button">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn_orange btn_w3 btn_size4', 'name' => 'signup-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<!-- - - - - - - - - - - - - - End of something_container - - - - - - - - - - - - - - - --->
