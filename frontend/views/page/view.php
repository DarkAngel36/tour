<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 20.03.2019
 * Time: 4:55
 */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Отели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $model->content?>
