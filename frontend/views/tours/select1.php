<?php
use kartik\depdrop\DepDrop;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\models\HotelsSearch;

/**
 * @var $this         yii\web\View
 * @var $dataProvider ActiveDataProvider
 * @var searchModel ToursSearch
 */

$this->title = 'Подбор тура';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- - - - - - - - - - - - - - select_tour_container - - - - - - - - - - - - - - - --->
<div class="select_tour_container indent_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2 class="al_center mb56">Подбор железнодорожного тура</h2>
                <div class="step_container">
                    <a class="link-xl link-blue-lite bd current" href="/tours/select1">01. Подбор тура</a>
                    <a class="link-xl link-blue-lite bd" href="/tours/select2">02. Заполнение информации</a>
                    <a class="link-xl link-blue-lite bd" href="/tours/select3">03. Бронирование</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                    <?php $form = ActiveForm::begin([
	                    'id'      => 'frmSelect1',
	                    'options' => ['class' => 'railway_tour_form view2']
                    ]); ?>
                    <div class="form_row_3_col mb25">
                        <div class="form_row">
                            <label class="form_label mb9 fz14">Откуда</label>
                            <?= \yii\helpers\Html::activeDropDownList($searchModel,
                                'cityFrom',
                                \common\models\Cities::getCitiesFrom(),
                                ['class' => 'styler form_select', 'prompt' => 'Выберите город'])?>
                        </div>
                        <div class="form_row">
	                        <label class="form_label mb9 fz14">Куда</label>
	                        <?= \yii\helpers\Html::activeDropDownList($searchModel,
		                        'city_id',
		                        \common\models\Cities::getCitiesTo(),
		                        ['class' => 'styler form_select', 'prompt' => 'Выберите город'])?>
                            <!--
	                        -->
                        </div>
                        <div class="form_row">
	                        <?= $form->field($searchModel, 'period',['labelOptions' => ['class' => 'form_label mb9 fz14'],])
		                        ->widget(DepDrop::classname(), [
			                        'options'=>[
				                        'id'    => 'period-id',
				                        'class' => 'form_select'
			                        ],
			                        'type' => DepDrop::TYPE_SELECT2,
			                        'select2Options' => [
				                        'pluginOptions' => ['allowClear' => true],
				
				                        'class' => ' form_select'
			                        ],
			                        'pluginOptions'=>[
				                        'depends'     => ['hotelssearch-city_id', 'hotel-id'],
				                        'placeholder' =>'Выберите период...',
				                        'url'         =>Url::to(['/tours/get-ajax-filter/?type=period']),
				                        'initialize'  => true,
				                        'loadingText' => 'Loading  ...',
			                        ]
		                        ]);?>
                            <a class="link-xs link-bd mt8" href="#">Нужно больше дней?</a>
                        </div>
                    </div>
                    <div class="form_row_3_col mb46">
                        <div class="form_row">
	                        <?= $form->field($searchModel, 'id', ['labelOptions' => ['class' => 'form_label mb9 fz14'],])
		                        ->widget(DepDrop::classname(), [
			                        'options'=>[
				                        'id'=>'hotel-id',
				                        'class' => 'form_select'
			                        ],
			                        'type' => DepDrop::TYPE_SELECT2,
			                        'select2Options' => [
				                        'pluginOptions' => ['allowClear' => true],
				
				                        'class' => ' form_select'
			                        ],
			                        'pluginOptions'=>[
				                        'depends'     => ['hotelssearch-city_id'],
				                        'placeholder' =>'Выберите город...',
				                        'url'         =>Url::to(['/tours/get-ajax-filter/?type=hotel']),
				                        'initialize'  => true,
				                        'loadingText' => 'Loading  ...',
			                        ]
		                        ])->label('Отель'); ?>
                        </div>
                        <div class="form_row">
                            <div class="form_row_col">
                                <div class="form_row">
                                    <label class="form_label mb9 fz14">Взрослых</label>
                                    <div class="p_rel d_ib">
                                        <input class="styler form_input_number js-input-number" type="number" min="0" />
                                        <div class="js-dropdown-input dropdown-input">
                                            <div class="dropdown-input-item">
                                                <div class="dropdown-input-title">Возраст детей</div>
                                                <div class="dropdown-input-box"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_row">
                                    <label class="form_label mb9 fz14">Детей</label>
                                    <div class="p_rel d_ib">
                                        <input class="styler form_input_number js-input-number" type="number" min="0" />
                                        <div class="js-dropdown-input dropdown-input">
                                            <div class="dropdown-input-item">
                                                <div class="dropdown-input-title">Возраст детей</div>
                                                <div class="dropdown-input-box"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_button">
	                        <button class="btn_orange btn_w2 btn_size3 btn_uppercase" id="btnSelect">Подобрать</button>
                            <div class="al_center">
                                <a class="link-sm" href="javascript:;" data-popup="#enter_popup">Вход для агентов /
                                    <span class="blue-lite">Регистрация</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
<!--                </form>-->
	            <? \yii\widgets\Pjax::begin([
		            'id' => 'listItems',
	            ]) ?>
	            <div class="select_tour_box">
	                <?= ListView::widget([
		                'dataProvider' => $dataProvider,
		                'itemView'     => '_hotel_periods',
		                'itemOptions'  => [
			                'class' => 'select_tour_item clearfix',
		                ],
	                ]) ?>
	                <!--
										<div class="select_tour_item clearfix">
											<div class="about_tour_img2">
												<img src="/images/park_sm1.png" alt="" />
											</div>
											<div class="about_tour_text2">
												<div class="mb13">
													<h6 class="mb5">Анапа</h6>
													<h6 class="md">База отдыха «Чайка»</h6>
												</div>
												<div class="about_tour_bottom">
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
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Эконом</td>
															<td data-title="Стоимость">от 20 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">23.06.2018 — 01.07.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="select_tour_item clearfix">
											<div class="about_tour_img2">
												<img src="/images/park_sm2.png" alt="" />
											</div>
											<div class="about_tour_text2">
												<div class="mb13">
													<h6 class="mb5">Анапа</h6>
													<h6 class="md">База отдыха «Чайка»</h6>
												</div>
												<div class="about_tour_bottom">
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
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Эконом</td>
															<td data-title="Стоимость">от 20 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">23.06.2018 — 01.07.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="select_tour_item clearfix">
											<div class="about_tour_img2">
												<img src="/images/park_sm3.png" alt="" />
											</div>
											<div class="about_tour_text2">
												<div class="mb13">
													<h6 class="mb5">Анапа</h6>
													<h6 class="md">База отдыха «Чайка»</h6>
												</div>
												<div class="about_tour_bottom">
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
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Эконом</td>
															<td data-title="Стоимость">от 20 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">15.06.2018 — 23.06.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														<tr>
															<td data-title="Период тура">23.06.2018 — 01.07.2018</td>
															<td data-title="Категория номера">Стандарт</td>
															<td data-title="Стоимость">от 30 000 руб.</td>
															<td data-title="&nbsp;">
																<a class="link-md md" href="javascript:;">Выбрать</a>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
					-->
                </div>
	            <? \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>


<?php
$JS = <<<JS
	$(document).ready(function(){
		$(document).on('click', '#btnSelect', function (event) {
		var options = {
			type      : 'POST',
			url       : $('#frmSelect1').attr('action'),
			container : '#listItems', // id to update content
			data      : $('#frmSelect1').serialize(),
		};

		$.pjax.reload(options);
	});
	})
	
JS;

$this->registerJs($JS);

?>

<!-- - - - - - - - - - - - - - End of select_tour_container - - - - - - - - - - - - - - - --->