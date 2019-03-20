<?php
/**
 * common\models\Cities $city
 */

use common\models\Cities;
?>
    <h2 class="al_center mb70">Железнодорожные туры</h2>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="rest_place mb137">
                    <?php foreach ($cities as $city):?>
                    <div class="rest_place_item">
                        <img src="<?= Cities::getImgUrl("main/{$city->id}")?>" alt="" />
                        <div>
                            <span class="rest_place_text2"><?= $city->name?></span>
                            <a class="btn_orange btn_w4 btn_size5" href="javascript:;">Подробнее</a>
                        </div>
                    </div>
                    <?php endforeach?>
                </div>
                <?php foreach($tours as $key => $tour):?>
<!--                --><?php //die(print_r($tour->attributes))?>
                <?php if(($key % 2) == 0):?>
                    <?= $this->render('@frontend/widgets/cities/views/index/list/tour1', ['model' => $tour])?>
                <?php else:?>
                    <?= $this->render('@frontend/widgets/cities/views/index/list/tour2', ['model' => $tour])?>
                <?php endif;?>
                <?php endforeach?>
                <!--div class="row tour_box">
                    <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-6 col-xs-12">
                        <div class="tour_info">
                            <h2 class="reg mb36">Экскурсионные туры
                                <br> для школьников</h2>
                            <p class="mb31">Traveling on a tight budget often limits families and individuals from experiencing their vacation to the fullest. But with a little budgeting and research, you can enjoy a luxury vacation even on a tight budget.
                                After all, Create a Vacation Savings Plan</p>
                            <div>
                                <a class="btn_orange btn_w" href="javascript:;">Программа тура</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 top_767">
                        <div class="tour_img">
                            <img src="images/school_img.svg" alt="" />
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
