<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!-- - - - - - - - - - - - - - first_screen - - - - - - - - - - - - - - - --->
<div class="first_screen" style="background-image: url(images/first_screen.svg);">
    <div class="container">
        <div class="first_box">
            <h4 class="fz26 white mb30 al_center">Подбор железнодорожного тура</h4>
            <form class="railway_tour_form">
                <div class="form_row_col mb30">
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Откуда</label>
                        <select class="styler form_select">
                            <option>Выберите город</option>
                            <option>Выберите город</option>
                            <option>Выберите город</option>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Куда</label>
                        <select class="styler form_select">
                            <option>Выберите город</option>
                            <option>Выберите город</option>
                            <option>Выберите город</option>
                        </select>
                    </div>
                </div>
                <div class="form_row_col mb46">
                    <div class="form_row">
                        <label class="form_label mb9 fz14">Период тура</label>
                        <select class="styler form_select">
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
                                <input class="styler form_input_number" type="number" min="0" /> </div>
                            <div class="form_row">
                                <label class="form_label mb9 fz14">Детей</label>
                                <input class="styler form_input_number" type="number" min="0" /> </div>
                        </div>
                    </div>
                </div>
                <div class="form_button">
                    <button class="btn_orange btn_w2 btn_size3 btn_uppercase reg">Подобрать</button>
                    <div class="al_center">
                        <a class="link-sm link-white" href="javascript:;" data-popup="#enter_popup">Вход для агентов /
                            <span class="white2">Регистрация</span>
                        </a>
                    </div>
                </div>
            </form>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <p>В продаже имеются железнодорожные билеты по направлениям:</p>
                <ul class="ticket_list">
                    <li>
                        <span class="fz20 md">Казань - Анапа</span>
                        <a class="link-md" href="javascript:;">Просмотреть даты</a>
                    </li>
                    <li>
                        <span class="fz20 md">Казань - Сочи</span>
                        <a class="link-md" href="javascript:;">Просмотреть даты</a>
                    </li>
                </ul>
                <p class="mb0">Заявки на билеты отправлять на почту
                    <a class="md" href="mailto:pochta@yandex.ru">pochta@yandex.ru</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .ticket_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .about_container - - - - - - - - - - - - - - - --->
<div class="about_container indent_8">
    <div class="container">
        <div class="row tour_box">
            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-6 col-xs-12">
                <div class="tour_info fz16">
                    <h2 class="mb20">О нас</h2>
                    <p class="mb31">Traveling on a tight budget often limits families and individuals from experiencing their vacation to the fullest. But with a little budgeting and research, you can enjoy a luxury vacation even on a tight budget. After
                        all, Create a Vacation Savings Plan</p>
                    <p>Instead of trying to gather up enough money for vacation at the last minute, develop a savings plan at the start of each year. Save only $20 per week and you’ll have $1040.00 after 12 months. This can take care of the
                        hotel bill and maybe more if you find a great bargain!</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 top_767">
                <div class="tour_img">
                    <img src="/images/school_img.svg" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .about_container - - - - - - - - - - - - - - - --->
