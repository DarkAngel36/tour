<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
?>
<?php $this->beginPage() ?>
<!Doctype html>
<html lang="<?= Yii::$app->language ?>">
<!-- Head Start     ============================================ -->
<head>
    <!-- Basic page needs     ============================================ -->
    <title>Главная страница</title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- Meta tags for social networks     ============================================-->
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="/images/preview.jpg" />
    <!-- IE Support     "IE=edge","IE=11","IE=10","IE=9","IE=8"     ============================================ -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile specific metas     ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Disable conversion of telephone numbers     ============================================ -->
    <meta name="format-detection" content="telephone=no" />

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Favicon     ============================================-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/images/favicon-16.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="/images/favicon-32.png" sizes="32x32" type="image/png" />
    <link rel="icon" href="/images/favicon-48.png" sizes="48x48" type="image/png" />
    <link rel="icon" href="/images/favicon-62.png" sizes="62x62" type="image/png" />
    <link rel="icon" href="/images/favicon-192.png" sizes="192x192" type="image/png" />
    <!-- Include Fonts (Icons)     ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;amp;subset=cyrillic" rel="stylesheet" />
    <link rel="stylesheet" media="screen" href="/css/font.css" />
    <!-- Include Libs CSS     ============================================ -->
    <link rel="stylesheet" media="screen" href="/css/reset.css" />
    <link rel="stylesheet" media="screen" href="/css/bootstrap.css" />
    <!-- Theme CSS     ============================================ -->
    <link rel="stylesheet" media="screen" href="/css/style.css" />
    <link rel="stylesheet" media="screen" href="/css/responsive.css" />
    <?php $this->head() ?>
<!-- Head End       ============================================ -->
</head>
<!-- Body Start     ============================================ -->

<body>
<?php $this->beginBody() ?>
<!--[if lte IE 9]><div class="browse-happy"><h3>You are using an <strong>outdated</strong> browser. Please<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</h3></div><![end if]-->
<div class="page_wrap">
    <!-- Preloader Start     ============================================ -->
    <div id="page-preloader">
        <span class="preloader"></span>
    </div>
    <!-- Preloader End       ============================================ -->
    <!-- Header Start     ============================================ -->
    <!-- <?= Yii::$app->controller->id?>-->
    <!-- <?= Yii::$app->controller->action->id?>-->
    <?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index'):?>
        <?= $this->render('_index_header')?>
    <?php else:?>
        <?= $this->render('_page_header')?>
    <?php endif?>
    <!-- Header End       ============================================ -->
    <!-- Content Start     ============================================-->
    <main id="content">
        <!-- - - - - - - - - - - - - - .title_box - - - - - - - - - - - - - - - --->
<?php if(/*Yii::$app->controller->id !== 'site' && */Yii::$app->controller->action->id !== 'index'):?>
        <div class="title_box bg_blue">
            <h1 class="white"><?= $this->title?></h1>
        </div>
<?php endif?>
        <!-- - - - - - - - - - - - - - End of .title_box - - - - - - - - - - - - - - - --->
        <!-- - - - - - - - - - - - - - private_office - - - - - - - - - - - - - - - --->
        <?php if(!Yii::$app->user->isGuest /*&& Yii::$app->controller->id !== 'site'*/ && Yii::$app->controller->action->id !== 'index'):?>
        <div class="private_office">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 al_right">
                        <div class="private_name">
                            <span><?= Yii::$app->user->identity->getFullName()?></span>
                            <ul class="private_dropdown">
                                <li>
                                    <a href="/site/user-lk">Личный кабинет</a>
                                </li>
                                <li>
                                    <a href="/site/user-profile">Редактировать</a>
                                </li>
                                <li>
                                    <a href="/site/logout">Выйти</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
<?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id='index'):?>
<?php else:?>
        <!-- - - - - - - - - - - - - - .breadcrumbs_container - - - - - - - - - - - - - - - --->
        <div class="breadcrumbs_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">

            <?= Breadcrumbs::widget([
            'itemTemplate' => '<li class="breadcrumbs_it fz18" data-bread-arr="/"><span class="breadcrumbs_current">{link}</span></li>'."\n",
            'activeItemTemplate' => '<li class="breadcrumbs_it fz18" data-bread-arr="/"><span class="breadcrumbs_current">{link}</span></li>'."\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class'=>'breadcrumbs clearfix']
        ]) ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- - - - - - - - - - - - - - End of .breadcrumbs_container - - - - - - - - - - - - - - - --->
        <?php endif?>
        <!-- - - - - - - - - - - - - - End of private_office - - - - - - - - - - - - - - - --->
        <?= $content ?>
    </main>
    <!-- Content End       ============================================-->
    <!-- Footer Start     ============================================ -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="footer_container">
                        <div class="logo">
                            <a href="index.html">ИМПЕРИЯ
                                <br>ТУРИЗМА и К</a>
                        </div>
                        <div class="footer_box_wrap">
                            <div class="footer_box">
                                <ul class="footer_list">
                                    <li>
                                        <a href="/tours">Подбор тура</a>
                                    </li>
                                    <li>
                                        <a href="/tours">Экскурсионные туры</a>
                                    </li>
                                    <li>
                                        <a href="/hotels">Черное море</a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute(['/pgae/view', 'id' => 2])?>">Агенствам</a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute(['/pgae/view', 'id' => 3])?>">Туристам</a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute(['/pgae/view', 'id' => 4])?>">Контакты</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer_box">
                                <ul class="footer_list">
                                    <li>
                                        <a href="javascript:;">Анапа</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Геленджик</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Сочи</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Сочи</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Сочи</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer_box">
                                <div class="footer_info">
                                    <div class="footer_tel">
                                        <p>Телефоны:</p>
                                        <p>+7 (890) 890-98-98</p>
                                        <p>+7 (890) 890-98-98</p>
                                    </div>
                                    <div class="footer_emeil">
                                        <p>Электронная почта:</p>
                                        <p>pochta@yandex.ru</p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer_box">
                                <div class="footer_info">
                                    <div class="footer_adress">
                                        <p>Адрес:</p>
                                        <p>г. Казань</p>
                                        <p>Декабристов, 81Б</p>
                                    </div>
                                    <div class="footer_time">
                                        <p>Часы работы:</p>
                                        <p>пн-пт 9:00-20:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- - - - - - - - - - - - - - End of footer_container - - - - - - - - - - - - - - - --->
    </footer>
    <!-- Footer End       ============================================ -->
    <!-- Popup Start     ============================================-->
    <div class="d_none">
        <div class="arcticmodal_container_box" id="request_popup">
            <div class="arcticmodal-close">&times;</div>
            <div>Для отмены заявки, свяжитесь с нами по телефону +7 (819) 987-90-90</div>
        </div>
        <?= $this->render('_login')?>

        <div class="arcticmodal_container_box popup_indent2 al_center" id="pay_popup">
            <div class="arcticmodal-close">&times;</div>
            <h2 class="md mb40">Оплата</h2>
            <a class="btn_w5 btn-blue btn_size6 mb17" href="javascript:;">Оплата картой</a>
            <a class="btn_w5 btn-blue btn_size6" href="javascript:;">Оплата по реквизитам</a>
        </div>
    </div>
    <!-- Popup End       ============================================-->
</div>


<!-- Include Libs     ============================================ -->
<!--<script src="/js/jquery-3.2.1.min.js"></script>-->
<!--<script src="/js/jquery-migrate-3.0.1.min.js"></script>-->
<!-- Include Libs End       ============================================ -->
<!-- Scripts Init Plugins & Core START     ============================================ -->
<!--<script src="/js/script.init.js"></script>-->
<!--<script src="/js/script.core.js"></script>-->
<!-- Scripts Init Plugins & Core END       ============================================ -->
<style>
    .indent_11 {
        padding-top: 35px;
        padding-bottom: 93px;
    }
</style>
<?php $this->endBody() ?>
</body>
<!-- Body End       ============================================ -->
</html>
<?php $this->endPage() ?>