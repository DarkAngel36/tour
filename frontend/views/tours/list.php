<?php
/**
* $this yii/web/View
 */
$this->title = 'Экскурсионные туры';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- - - - - - - - - - - - - - .title_box - - - - - - - - - - - - - - - --->

<!-- - - - - - - - - - - - - - End of .title_box - - - - - - - - - - - - - - - --->
<!-- - - - - - - - - - - - - - .tour_container - - - - - - - - - - - - - - - --->
<div class="tour_container indent_11">
    <div class="container">
        <?php foreach ($items as $key=>$item):?>
        <?php if($key % 2 == 0):?>
        <?= $this->render('_left', ['item' => $item]) ?>
        <?php else:?>
        <?= $this->render('_right', ['item' => $item]) ?>
        <?php endif?>
        <?php endforeach;?>
        <?php if(!count($items)):?>
        Туры не найдены
        <?php endif?>
    </div>
</div>
<!-- - - - - - - - - - - - - - End of .tour_container - - - - - - - - - - - - - - - --->