<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 17.03.2019
 * Time: 18:14
 */

$imgs = $item->getImagesPreview('main', '448x298');
//die(print_r($imgs));
?>

<div class="container">
    <div class="row tour_box">
        <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-6 col-xs-12">
            <div class="tour_info fz16">
                <h2 class="mb20"><?= $item->title?></h2>
                <?= $item->content?>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 top_767">
            <div class="tour_img">
                <img src="<?= $imgs['initialPreview'][0]?>" alt="" />
            </div>
        </div>
    </div>
</div>
