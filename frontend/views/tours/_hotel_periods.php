<?php
/* @var $searchModel \common\models\HotelsSearch */
?>

<!--<div class="select_tour_item clearfix">-->
	<div class="about_tour_img2">
		<img src="/images/park_sm1.png" alt=""/>
	</div>
	<div class="about_tour_text2">
		<div class="mb13">
			<h6 class="mb5"><?= $model->city->name ?></h6>
			<h6 class="md"><?= $model->name ?></h6>
		</div>
		<div class="about_tour_bottom">
			<?php if (count($model->hotelsPeriods)): ?>
				<table class="about_tour_table version2">
					<thead>
					<tr>
						<th>Период тура</th>
						<th>Категория номера</th>
						<th>Стоимость</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($model->hotelsPeriods as $item): ?>
						<tr>
							<td data-title="Период тура"><?= $item->from ?> — <?= $item->to ?></td>
							<td data-title="Категория номера"><?= $item->category ?></td>
							<td data-title="Стоимость">от <?= $item->cost ?> руб.</td>
							<td data-title="&nbsp;">
								<a class="link-md md"
								   href="<?= \yii\helpers\Url::to([
									   'tours/select2',
									   'hotel_id'     => $model->id,
									   'period_id'    => $item->id,
									   'parentsCount' => $searchModel->parentsCount,
									   'childCount'   => $searchModel->childCount,
								   ]) ?>">Выбрать</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php else: ?>
				<strong>Туров нет</strong>
			<?php endif ?>
		</div>
	</div>
<!--</div>-->
