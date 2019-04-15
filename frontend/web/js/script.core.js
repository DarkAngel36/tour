;(function($){

	"use strict";

	var Core = {

		DOMReady: function(){

			var self = this;

			self.firstScreen.init();
			self.mainMenu();
			self.tableAdd.init();
			self.inputLength.init();
			self.selectionTour.init();

		},

		windowLoad: function(){

			var self = this;

			self.preloader();
			if($('.ymap').length){
				self.mapYa();
			}

		},

		selectionTour:{

			init: function(){

				var self = this;
					self.ckeckForm = $('.js-ckeckForm');
					self.checkToggle = $('#coach_checkbox');
					// self.place = $('.railway_section_place');

				self.checkLoad();
				self.clickCheked();
				self.clickPlace();

			},

			checkLoad: function(){

				var self = this;

				if(self.checkToggle.is(':checked')){
					self.checkToggle.addClass('active').prop('checked', true);
				    self.changeTrain('true');
				}
				else{
					self.checkToggle.removeClass('active').prop('checked', false);
					self.changeTrain('false');
				}

			},

			clickCheked: function(){

				var self = this;

				self.ckeckForm.on('click', function(event) {

					var $this = $(this);

						if($this.attr('data-toggle-check') == "off"){
							self.checkToggle.removeClass('active').prop('checked', false);
							self.changeTrain('false');
						}
						if($this.attr('data-toggle-check') == 'on'){
							self.checkToggle.addClass('active').prop('checked', true);
							self.changeTrain('true');
						}

				});

				self.checkToggle.on('click', function(event) {

					var $this = $(this);

					if(!$this.is(':checked')){
				        $this.removeClass('active').prop('checked', false);
				        self.changeTrain('false');
				    }
				    else {
				        $this.addClass('active').prop('checked', true);
				        self.changeTrain('true');
				    }

				});

			},

			changeTrain: function(check){

				var self = this;

				if(check == 'true'){

					$('.railway_box_wrap[data-toggle-check="on"]').addClass('active').show().siblings().removeClass('active').hide();
					// console.log(1)
				}
				if(check == 'false'){
					$('.railway_box_wrap[data-toggle-check="off"]').addClass('active').show().siblings().removeClass('active').hide();
					// console.log(2)
				}

			},

			clickPlace: function(){

				var self = this;

				$('.railway_section_place:not(.reserved)').on('click',  function(event) {
					event.preventDefault();

					var $this = $(this);

					if(!$(this).hasClass('current')){

						if (places <= countPlaces) {
							alert('Вы уже выбрали достаточно мест');
							return false;
						}

						if($(this).hasClass('last_place') && $(this).siblings('.first_place').hasClass('current')){
							$(this).addClass('current').parent().removeClass('not_selected');
						}
						else if( $(this).hasClass('first_place') && !$(this).closest('.railway_box').find('.not_selected').length ){
							$(this).addClass('current').parent().addClass('not_selected');
						}

					}
					else{

						if($(this).hasClass('last_place')  && !$(this).closest('.railway_box').find('.not_selected').length ){
							$(this).removeClass('current').parent().addClass('not_selected');
						}
						else if($(this).hasClass('first_place') && !$(this).siblings('.last_place').hasClass('current')){
							$(this).removeClass('current').parent().removeClass('not_selected');;
						}

					}

					countPlaces = $('.railway_section_place.current').length;
				});

			}


		},

		inputLength:{

			init: function(){

				var self = this;
					self.inputNumber = $('.js-input-number');

				self.changeInput();
			},

			changeInput: function(){

				var self = this;

				$('body').on('click', '.jq-number__spin', function(event) {
					var parent = $(this).closest('.jq-number');

					self.dropdownOpen(parent);
				});

				self.inputNumber.on('change oninput',  function(event) {
					var parent = $(this).closest('.jq-number');

					self.dropdownOpen(parent);
				});

			},

			dropdownOpen: function(parent){

				var self = this,
					$inputDropdown = $(parent).next('.js-dropdown-input'),
					$inputBox = $inputDropdown.find('.dropdown-input-box'),
					$inputLength = $inputBox.find('input'),
					$inpVal =  $(parent).find('.js-input-number').val(),
					$inputTemplate = '<input type="text"/>';

				if($inpVal > 0){
					$inputDropdown.addClass('active')
				}
				else{
					$inputDropdown.removeClass('active')
				}

				if($inpVal > $inputLength.length){

					for (var i = ($inpVal - $inputLength.length) - 1; i >= 0; i--) {
						$inputBox.append($inputTemplate);
					}
				}
				else{
					for (var i = $inputLength.length - 1; i >= 0; i--) {
						console.log($inpVal)
						if(i > $inpVal-1){
							$($inputLength[i]).remove();
						}
					}
				}

			}


		},

		/**
		**	tableAdd
		**/

		tableAdd:{
			init: function(){

				var self = this;
					self.table = $('.table_list');
					self.tableTrField = self.table.find('.table_tr_input');
					self.tableTrAdd = self.table.find('.table_tr_add');
					self.addTrLink = $('.js-add-tr');
					self.afterTable = $('.after_table');
					self.saveLink = $('.js-save-table');

				self.addTr();
				self.saveValue();

			},

			addTr: function(){

				var self = this;

				self.addTrLink.on('click', function(event) {
					event.preventDefault();

					self.afterTable.css({
						opacity: 1,
						visibility: 'visible'
					});

					self.tableTrField.addClass('active').css({
						display: 'table-row'
					});

					self.tableTrAdd.css({
						display: 'none'
					});

				});

			},

			saveValue: function(){

				var self = this;

				self.saveLink.on('click', function() {
					var template = "<tr class='table_last_value'>";
					self.table.find('.table_tr_input td').each(function(index, el) {
						var $inputval = $(el).find('input').val();
						$(el).find('input').val('');
						template += '<td>'+ $inputval +'</td>';
					});
					template += "</tr>"

					self.tableTrField.removeClass('active').css('display', 'none').before(template);

					self.tableTrAdd.css({
						display: 'table-row'
					});

					self.afterTable.css({
						opacity: 0,
						visibility: 'hidden'
					});

				});
			}

		},

		/**
		**	Yandex Map
		**/

	    mapYa: function(){

	    	ymaps.ready(init);

		    var myMap,
		    	myCollection,
		        myPlacemark;

		    function init(){

		    	// Инициализация карты START
			        myMap = new ymaps.Map ("ymap", {
			            center: [46.97389593, 31.96580094],
			            zoom: 15
			        });

			    // Инициализация карты END




				// Добавление или удаление элементов управления START

					// myMap.controls.remove('geolocationControl').remove('searchControl').remove('routeEditor').remove('trafficControl').remove('typeSelector').add('fullscreenControl').add('zoomControl').remove('rulerControl');

				// Добавление или удаление элементов управления END



		        // Поведение карты
			        myMap.behaviors
				    .disable(['scrollZoom']) //отключает поведение
				    .enable(['drag', 'dblClickZoom', 'multiTouch']); //включает поведение


			    // Подгоним размер карты под новый размер контейнера
				// (например, если изменилась верстка страницы или карта была инициализирована
				// в скрытом состоянии)
					myMap.container.fitToViewport();

		        // Коллекции иконок маркера
			        myCollection = new ymaps.GeoObjectCollection({}, {
				       	iconLayout: 'default#image',
				        iconImageHref: 'images/ymap.png',
				        iconImageSize: [42, 56],
				        iconImageOffset: [-30, -60]
				    });


		        // Маркеры
			        myPlacemark = new ymaps.Placemark([46.97389593, 31.96580094]
			      //   , {
			      //   	balloonContentHeader: '<img src="images/logo.png" alt="" /><div class="head_map">Логово</div>',
					    // balloonContentBody: 'Живу я ',
					    // balloonContentFooter: 'Привет ',
					    // hintContent: 'В этом доме живу я'
			      //   }
			        );



		        // Глобальная коллекция - добавление меток
			        myCollection.add(myPlacemark);
			        myMap.geoObjects.add(myCollection);
			        // Открытие попапа после загрузки страницы
			        // myPlacemark.balloon.open();


		    }

	    },

		/**
		**	First screen
		**/

		firstScreen: {

			init: function(){

				var self = this;

					self.w = $(window);
					self.box = $('.first_screen');
					self.header = $('#header');

				self.event();

				self.w.on('resize', function(){
					self.event();
				});

			},

			event: function(){

				var self = this;
					self.headerH = self.header.outerHeight();

				if(self.box.length){
					self.box.css({
						'margin-top': -self.headerH
					})
				}

			},

		},

		/**
		**	Main Menu
		**/

		mainMenu: function(){

			$('.js-btn-menu').on('click', function(){
				$(this).toggleClass('active');
				$('.menu').toggleClass('open');
			});

		},

		/**
		**	Preloader
		**/

		preloader: function(){

			var self = this;

			self.preloader = $('#page-preloader');
	        self.spinner   = self.preloader.find('.preloader');

		    self.spinner.fadeOut();
		    self.preloader.delay(350).fadeOut('slow');
		},

	}


	$(document).ready(function(){

		Core.DOMReady();

	});

	$(window).load(function(){

		Core.windowLoad();

	});

})(jQuery);