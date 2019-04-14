<?php

/* @var $this yii\web\View */

use common\models\Cities;
use yii\widgets\ActiveForm;
$this->title = 'My Yii Application';
$citiesFrom = Cities::getCitiesFrom();
$citiesTo = Cities::getCitiesTo();
?>
<!-- - - - - - - - - - - - - - first_screen - - - - - - - - - - - - - - - --->
<div class="first_screen" style="background-image: url(images/first_screen.svg);">
    <div class="container">
        <div class="first_box">
            <h4 class="fz26 white mb30 al_center">Подбор железнодорожного тура</h4>
            
            <?php $form = ActiveForm::begin([
	            'action' => \yii\helpers\Url::toRoute('/tours/select'),
	            'options' => [
                    'class' => 'railway_tour_form',
                    
                    'method' => 'post',
	            ]
            ]); ?>
                <div class="form_row_col mb30">
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Откуда</label>
                        <select class="styler form_select" name="ToursSearch[cityFrom]">
                            <option>Выберите город</option>
                            <?php foreach($citiesFrom as $id => $cityFrom):?>
                            <option value="<?= $id?>"><?= $cityFrom?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Куда</label>
	                    <select class="styler form_select" name="HotelsSearch[city_id]">
                            <option>Выберите город</option>
                            <?php foreach($citiesTo as $id => $cityFrom):?>
                                <option value="<?= $id?>"><?= $cityFrom?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="form_row_col mb46">
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Период тура</label>
                        <select class="styler form_select" name="ToursSearch[period]">
                            <option>Дата отправления</option>
                            <option>Дата отправления</option>
                            <option>Дата отправления</option>
                        </select>
                        <a class="link-xs link-white link-bd mt8" href="#">Нужно больше дней?</a>
                    </div>
                    <div class="form_row">
                        <div class="form_row_col">
                            <div class="form_row">
                                <label class="form_label mb9 fz14">Взрослых</label>
                                <input class="styler form_input_number" type="number" min="0" value="1" name="ToursSearch[parentsCount]" /> </div>
                            <div class="form_row">
                                <label class="form_label mb9 fz14">Детей</label>
                                <input class="styler form_input_number" type="number" min="0" value="0" name="ToursSearch[childCount]" /> </div>
                        </div>
                    </div>
                </div>
                <div class="form_button">
                    <button class="btn_orange btn_w2 btn_size3 btn_uppercase reg">Подобрать</button>
                    <?php if(Yii::$app->user->isGuest):?>
                    <div class="al_center">
                        <a class="link-sm link-white" href="javascript:;" data-popup="#enter_popup">Вход для агентов /
                            <span class="white2">Регистрация</span>
                        </a>
                    </div>
                    <?php endif?>
                </div>
	        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of first_screen - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .railway_section - - - - - - - - - - - - - - - --->
<section class="railway_section indent_12">
    <?= \frontend\widgets\cities\IndexListRail::widget()?>
</section>
<!-- - - - - - - - - - - - - - End of .railway_section - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .ticket_container - - - - - - - - - - - - - - - --->
<div class="ticket_container bg_blue_lite2 indent_7">
    <?= \frontend\widgets\TicketsList::widget()?>
</div>
<!-- - - - - - - - - - - - - - End of .ticket_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .about_container - - - - - - - - - - - - - - - --->
<div class="about_container indent_8">
    <?= \frontend\widgets\cities\PageWidget::widget(['code' => 'cbout'])?>
</div>
<!-- - - - - - - - - - - - - - End of .about_container - - - - - - - - - - - - - - - --->
