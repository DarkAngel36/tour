<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<?php Pjax::begin([
    'enablePushState' => false
])?>
<div class="arcticmodal_container_box popup_indent" id="enter_popup">
    <div class="arcticmodal-close">&times;</div>
    <h3 class="md al_center mb30">Вход для агентов</h3>
    <?php $login = new \common\models\LoginForm();?>
    <?php $form = ActiveForm::begin([
        'class'=>'agent_registration_form',
        'id'=>'login_form',
        'action'=>'/site/login',
        'method' => 'post'
        ]) ?>
    <!--            <form class="agent_registration_form">-->
    <div class="form_row mb20">
        <div class="form_label">E-mail</div>
        <!--                    <input class="form_input" type="text" />-->
        <?= Html::activeTextInput($login, 'email', ['class' => 'form_input'])?>
    </div>
    <div class="form_row mb30">
        <div class="form_label">Пароль
            <span>(
                <a class="link-lg link-blue-lite link-bd" href="javascript: void(0)" onclick="$('#login_form')[0].submit(); retur false;">Забыли пароль?</a>)</span>
        </div>
<!--        <input class="form_input mb10" type="text" />-->
        <?= Html::activePasswordInput($login, 'password', ['class' => 'form_input mb10'])?>
        <div class="al_right">
            <a data-pjax="0" class="link_reg link-sm2 link-blue-lite link-bd" href="/site/signup">Зарегистрироваться</a>
        </div>
    </div>
    <div class="form_button">
        <button class="btn_orange btn_w">Войти</button>
    </div>
    <!--            </form>-->
    <?php ActiveForm::end() ?>
</div>
<?php Pjax::end()?>