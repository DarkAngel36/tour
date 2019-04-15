<?php
/* @var $hotelModel \common\models\Hotels */
/* @var $periodModel \common\models\HotelsPeriod */

?>
<!-- - - - - - - - - - - - - - select_tour_container - - - - - - - - - - - - - - - --->
<div class="select_tour_container indent_2">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<h2 class="al_center mb56">Подбор железнодорожного тура</h2>
				<div class="step_container">
					<a class="link-xl link-blue-lite bd" href="/tours/select1">01. Подбор тура</a>
					<a class="link-xl link-blue-lite bd current" href="/tours/select2">02. Заполнение информации</a>
					<a class="link-xl link-blue-lite bd" href="/tours/select3">03. Бронирование</a>
				</div>
			</div>
		</div>
		<div class="row select_tour_wrap mb25">
			<div class="col-lg-4 col-lg-offset-1 col-md-6 col-sm-6">
				<div class="group_info">
					<h4 class="mb13"><?= $hotelModel->city->name ?></h4>
					<h6 class="md mb20"><?= $hotelModel->name ?></h6>
					<ul class="group_list">
						<li>
							<div>ФИО</div>
							<div>Иванов Иван Иванович</div>
						</li>
						<li>
							<div>Период тура</div>
							<div><?= $periodModel->from ?> — <?= $periodModel->to ?></div>
						</li>
						<li>
							<div>Категория номера</div>
							<div><?= $periodModel->category ?></div>
						</li>
						<li>
							<div>Тип тура</div>
							<div>Железнодорожный</div>
						</li>
						<li>
							<div>Количество человек</div>
							<div><?= $parentsCount + $childCount ?></div>
						</li>
						<!--
						<li>
							<div>Тип размещения</div>
							<div class="group_list_item">
								<div>1 номер — 2 взрослых</div>
								<div>1 номер — 1 взрослых</div>
								<div>1 номер — 2 взрослых</div>
								<a class="link-bd reg" href="javascript:;">+ Добавить номер</a>
							</div>
						</li>
						-->
					</ul>
					<div class="group_price m_b_zero">
						<span>Сумма к оплате</span>
						<span><?= $periodModel->cost * ($parentsCount + $childCount) ?> рублей</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-6 top_767">
				<div class="group_img2">
					<img src="/images/fountain.png" alt="" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-12">
				<h6 class="fz16 mb37 md al_center">Данные туристов</h6>
				<table class="tourist_table">
					<thead>
					<tr>
						<th>№ п/п</th>
						<th>Пол</th>
						<th>Фамилия</th>
						<th>Имя</th>
						<th>Отчество</th>
						<th>Дата рождения</th>
						<th>Паспорт</th>
						<th>Телефон</th>
						<th>E-mail</th>
					</tr>
					</thead>
					<tbody>
					<?php for ($i = 0; $i <= ($parentsCount + $childCount - 1); $i++): ?>
						<?php
						if (!isset($list[$i])) {
							$list[$i] = [
								'pol'          => '',
								'last_name'    => '',
								'first_name'   => '',
								'second_rname' => '',
								'birthday'     => '',
								'doc_cer'      => '',
								'doc_num'      => '',
								'phone'        => '',
								'email'        => '',
							];
						}
						?>
						<tr>
							<td data-table-title="№ п/п:"><?= $i + 1 ?></td>
							<td data-table-title="Пол">
								<div class="xs">
									<?= \yii\helpers\Html::textInput("list[{$i}][pol]", $list[$i]['pol']) ?> </div>
							</td>
							<td data-table-title="Фамилия">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][last_name]", $list[$i]['last_name']) ?> </div>
							</td>
							<td data-table-title="Имя">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][first_name]", $list[$i]['first_name']) ?> </div>
							</td>
							<td data-table-title="Отчество">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][second_rname]"), $list[$i]['second_rname'] ?> </div>
							</td>
							<td data-table-title="Дата рождения">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][birthday]", $list[$i]['birthday']) ?> </div>
							</td>
							<td data-table-title="Паспорт">
								<div class="df lg">
									<div class="sm">
										<?= \yii\helpers\Html::textInput("list[{$i}][doc_cer]", $list[$i]['doc_cer']) ?> </div>
									<div class="md">
										<?= \yii\helpers\Html::textInput("list[{$i}][doc_num]", $list[$i]['doc_num']) ?> </div>
								</div>
							</td>
							<td data-table-title="Телефон">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][phone]", $list[$i]['phone']) ?> </div>
							</td>
							<td data-table-title="E-mail">
								<div class="lg">
									<?= \yii\helpers\Html::textInput("list[{$i}][email]", $list[$i]['email']) ?> </div>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<div class="tourist_settings">
					<div class="tourist_settings_item">
						<h6 class="tourist_settings_title">Тип вагона</h6>
						<div class="coach_checked_place">
							<span class="js-ckeckForm md" data-toggle-check="off">Плацкарт</span>
							<input id="coach_checkbox" type="checkbox" />
							<label for="coach_checkbox"></label>
							<span class="js-ckeckForm md" data-toggle-check="on">Купе</span>
						</div>
					</div>
					<div class="tourist_settings_item">
						<span class="tourist_settings_square square_current"></span>
						<span>Выбранные места</span>
					</div>
					<div class="tourist_settings_item">
						<span class="tourist_settings_square square_empty"></span>
						<span>Свободные места</span>
					</div>
					<div class="tourist_settings_item">
						<span class="tourist_settings_square square_active"></span>
						<span>Занятые места</span>
					</div>
				</div>
				<div class="railway_container">
					<div class="railway_box_wrap" data-toggle-check="off">
						<div class="railway_box">
							<?php
							if (empty($places)) {
								for ($i = 0; $i <= 53; $i++) {
									$places[$i] = 0;
								}
							}
							?>
							<?php for ($i = 0; $i <= 9; $i++): ?>

								<div class="railway_box_item">
									<div class="railway_box_top mb40">
										<!-- first_place/last_place меняется на reserved--!>
										<div>
											<div data-num="<?= $i * 6 ?>"
											     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6], 'first_place') ?> mb20">в
											</div>
											<div data-num="<?= $i * 6 + 1 ?>"
											     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6 + 1], 'last_place') ?>">н
											</div>
										</div>
										<div>
											<img src="/images/icons/black_cloud.svg" alt="" />
										</div>
										<div>
											<div data-num="<?= $i * 6 + 2 ?>"
											     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6 + 2], 'first_place') ?> mb20">в
											</div>
											<div data-num="<?= $i * 6 + 3 ?>"
											     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6 + 3], 'last_place') ?>">н
											</div>
										</div>
									</div>
									<div class="railway_box_bottom">
										<div data-num="<?= $i * 6 + 4 ?>"
										     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6 + 4], 'first_place') ?>">н
										</div>
										<div data-num="<?= $i * 6 + 5 ?>"
										     class="railway_section_place <?= \common\models\Tours::getPlace($places[$i * 6 + 5], 'first_place') ?>">в
										</div>
									</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
					<div class="railway_box_wrap" data-toggle-check="on">
						<div class="railway_box">
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20 reserved">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
							<div class="railway_box_item">
								<div class="railway_box_top">
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
									<div>
										<img src="/images/icons/black_cloud.svg" alt="" />
									</div>
									<div>
										<div class="railway_section_place first_place mb20">в</div>
										<div class="railway_section_place last_place">н</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="al_center">
			<a class="btn_orange btn_w2 btn_size3 btn_uppercase md" href="javascript:;">Перейти к бронированию</a>
		</div>
	</div>
</div>
<!-- - - - - - - - - - - - - - End of select_tour_container - - - - - - - - - - - - - - - --->