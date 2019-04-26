<?php
$imgG                          = $model->getImagesPreview('gallery','168x144');
$img                           = $model->getImagesPreview('main','368x273');
$options                       = explode('<br />', nl2br($model->options));
$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['back-url']      = \yii\helpers\Url::to(['index']);
?>
<!-- - - - - - - - - - - - - - .about_tour_container - - - - - - - - - - - - - - - --->
<div class="about_tour_container indent_14">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1 col-sm-5">
                <div class="about_tour_img">
                    <img src="<?= $img['initialPreview'][0]?>" alt="" />
                </div>
            </div>
            <div class="col-md-6 col-sm-7">
                <div class="about_tour_text">
                    <div class="about_tour_top">
                        <div>
                            <h2 class="mb20"><?= $model->name?></h2>
                            <h6 class="md"><?= $model->city->name?></h6>
                        </div>
                        <div>
                            <a class="btn_orange btn_w reg" href="javascript:;">Скачать брошуру</a>
                        </div>
                    </div>
                    <div class="about_tour_bottom">
                        <ul class="mb25">
                            <li>
                                <span>Стоимость тура:</span>
                                <span><?= $model->cost?></span>
                            </li>
                            <li>
                                <span><?= $model->info?></span>

                            </li>
                        </ul>
                        <div>В стоимость входит:</div>
                        <ul class="about_tour_list">
                            <?php foreach($options as $option):?>
                            <li><?= $option?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .about_tour_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .carousel_container - - - - - - - - - - - - - - - --->
<div class="carousel_container bg_blue_lite indent_4">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="carousel_wrap">
                    <div class="owl-carousel js-carousel">
                        <?php foreach($imgG['initialPreview'] as $im):?>
                        <a class="carousel_item" href="javascript:;">
                            <img src="<?= $im?>" alt="" />
                        </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .carousel_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .text_container - - - - - - - - - - - - - - - --->
<div class="text_container indent_5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-lg-offset-1">
                <div class="text_box">
                    <h6 class="mb34">Программа тура</h6>
                    <?= $model->programm?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .text_container - - - - - - - - - - - - - - - --->