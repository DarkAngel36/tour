<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 20.03.2019
 * Time: 3:54
 */
$cities = \common\models\Cities::getCitiesTo();

$this->title = 'Отели';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hotel_container indent_10">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <aside>
                    <h4 class="mb34">Черное море</h4>
                    <ul class="city_list">
                        <?php foreach($cities as $id => $city):?>
                        <li>
                            <a <?php if(Yii::$app->request->get('city_id', 0) == $id):?>class="current"<?php endif?> href="<?= \yii\helpers\Url::toRoute(['index', 'city_id' => $id])?>"><?= $city?></a>
                        </li>
                        <?php endforeach?>
                    </ul>
                </aside>
            </div>
            <div class="col-lg-9 col-md-9">
                <?php foreach($items as $item):?>
                <?php $img = $item->getImagesPreview('main','268x216')?>
                <div class="rest_place_box clearfix">
                    <a class="rest_place_img" href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>" target="_blank">
                        <img src="<?= $img['initialPreview'][0]?>" alt="" />
                    </a>
                    <div class="rest_place_info">
                        <h4 class="rest_place_title md">
                            <a href="hotel.html"><?= $item->name?></a>
                        </h4>
                        <h6 class="rest_place_subtitle md"><?= $item->city->name?></h6>
                        <p><?= $item->description?></p>
                        <div class="rest_place_link_box">
                            <a class="btn_orange btn_w" href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>" target="_blank">Подобрать тур</a>
                            <a href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>">Читать подробнее…</a>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
</div>
