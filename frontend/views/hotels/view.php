<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 20.03.2019
 * Time: 4:25
 */
$imgG = $model->getImagesPreview('gallery','168x144');
$img = $model->getImagesPreview('main','368x276');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- - - - - - - - - - - - - - .about_tour_container - - - - - - - - - - - - - - - --->
<div class="about_tour_container indent_13">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-5">
                <div class="about_tour_img magnific_popup js-lightbox" data-mfp-src="/images/pool.png">
                    <img src="<?= $img['initialPreview'][0]?>" alt="" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-7">
                <div class="about_tour_text">
                    <div class="about_tour_top v2">
                        <div>
                            <h2 class="mb5"><?= $model->name?></h2>
                            <h6 class="md"><?= $model->city->name?></h6>
                        </div>
                        <div>
                            <a class="btn_orange btn_w reg" href="javascript:;">Скачать брошуру</a>
                        </div>
                    </div>
                    <div class="about_tour_bottom">
                        <table class="about_tour_table">
                            <thead>
                            <tr>
                                <th>Период тура</th>
                                <th>Категория номера</th>
                                <th>Стоимость</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td data-title="Наимен-ие">15.06.2018 — 23.06.2018</td>
                                <td data-title="Артикул">Эконом</td>
                                <td data-title="Наличие">от 20 000 руб.</td>
                            </tr>
                            <tr>
                                <td data-title="Наимен-ие">15.06.2018 — 23.06.2018</td>
                                <td data-title="Артикул">Стандарт</td>
                                <td data-title="Наличие">от 30 000 руб.</td>
                            </tr>
                            <tr>
                                <td data-title="Наимен-ие">23.06.2018 — 01.07.2018</td>
                                <td data-title="Артикул">Стандарт</td>
                                <td data-title="Наличие">от 30 000 руб.</td>
                            </tr>
                            </tbody>
                        </table>
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
                    <div class="owl-carousel js-carousel magnific_popup js-lightbox-gallery">
                        <?php foreach($imgG['initialPreview'] as $im):?>
                        <a class="carousel_item" href="<?= $im?>">
                            <img src="<?= $im?>" alt="" />
                        </a>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .carousel_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .text_container - - - - - - - - - - - - - - - --->
<div class="text_container indent_6">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-lg-offset-1">
                <div class="text_box">
                    <h6 class="mb34 md">Описание</h6>
                    <?= $model->description?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .text_container - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - ..another_rest_container - - - - - - - - - - - - - - - --->
<div class="another_rest_container bg_blue_lite indent_3 mb100">
    <div class="container">
        <h2 class="mb37">Другие места отдыха в <?= $model->city->name?></h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="place_box">
                    <div class="rest_place">
                        <?php
                        $hotels = \common\models\Hotels::find()
                            ->where(['city_id' => $model->city_id])
                            ->andWhere(['not', ['id' => $model->id]])
                            ->all();
                        ?>
                        <?php foreach($hotels as $hotel):?>
                        <?php $img = $model->getImagesPreview('main','268x216');?>
                        <div class="rest_place_item">
                            <img src="<?= $img['initialPreview'][0]?>" alt="" />
                            <div>
                                <span class="rest_place_text"><?= $hotel->name?></span>
                                <a class="btn_orange btn_w4 btn_size5" href="<?= \yii\helpers\Url::toRoute(['/hotels/view', 'id' => $hotel->id])?>">Подробнее</a>
                            </div>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of ..another_rest_container - - - - - - - - - - - - - - - --->
