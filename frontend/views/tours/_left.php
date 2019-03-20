<?php
$img = $item->getImagesPreview('main','468x331')
?>
<div class="row tour_box">
    <div class="col-lg-5 col-lg-offset-1 col-sm-6 col-xs-12 top_767">
        <a class="tour_img" href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>">
            <img src="<?= $img['initialPreview'][0]?>" alt="" />
        </a>
    </div>
    <div class="col-lg-5 col-sm-6 col-xs-12">
        <div class="tour_info">
            <h2 class="mb20">
                <a href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>"><?= $item->city->name?> - <?= $item->name?></a>
            </h2>
            <p class="mb20"><?= nl2br($item->cost)?><br><?= nl2br($item->info)?></p>
            <p class="mb20"><?= nl2br($item->short_description)?></p>
            <div class="tour_link">
                <a class="link-icon-right link-sm md" href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>">Программа тура
                    <i>
                        <img src="/images/icons/arrow_right.svg" alt="" />
                    </i>
                </a>
            </div>
            <div>
                <a class="btn_orange btn_w" href="<?= \yii\helpers\Url::toRoute(['view', 'id' => $item->id])?>">Заказать тур</a>
            </div>
        </div>
    </div>
</div>