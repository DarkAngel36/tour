<?php
$imgs = $model->getImagesPreview('main', '448x298');
$imgs = $imgs['initialPreview'];
?>
<div class="row tour_box">
    <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-6 col-xs-12">
        <div class="tour_info">
            <h2 class="reg mb36"><?= $model->name?></h2>
            <p class="mb31"><?= $model->info?></p>
            <div>
                <a class="btn_orange btn_w" href="<?= \yii\helpers\Url::to(['/tours/view','id' => $model->id])?>">Программа тура</a>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 top_767">
        <div class="tour_img">
            <img src="<?= !empty($imgs[0]) ? $imgs[0] : ''?>" alt="" />
        </div>
    </div>
</div>