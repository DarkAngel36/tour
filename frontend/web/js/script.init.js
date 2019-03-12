//  /*================================================>
//                                 >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  INCLUDE AND INITIALIZE Plugins START  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//  <================================================*/





		var mask	   	= $('input[type="tel"]'),
		    styler 		= $(".styler"),
		    owl 		= $(".owl-carousel"),
		    popup 		= $("[data-popup]"),
			mapYa		= $('.ymap'),
			slick       = $(".js-slick"),
			magnificPopup = $(".magnific_popup");

			if(magnificPopup.length){
					include("plugins/magnific-popup/jquery.magnific-popup.min.js");
					includeCss("plugins/magnific-popup/magnific-popup.css");
			}
			if(slick.length){
					include("plugins/slick/slick.js");
					includeCss("plugins/slick/slick.css");
					includeCss("plugins/slick/slick-theme.css");
			}
			if(styler.length){
					include("plugins/formstyler/formstyler.js");
					includeCss("plugins/formstyler/formstyler.css");
			}
			if(owl.length){
			 		include('plugins/owl-carousel/owl.carousel.js');
			 		includeCss("plugins/owl-carousel/owl.carousel.min.css");
			}
			if(mask.length){
					include("plugins/inputmask/inputmask.js");
					include("plugins/inputmask/inputmask.phone.extensions.js");
					include("plugins/inputmask/jquery.inputmask.js");
			}
			if(mapYa.length){
			 		include("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
			}
			// if(popup.length){
					include("plugins/arcticmodal/jquery.arcticmodal.js");
					includeCss("plugins/arcticmodal/jquery.arcticmodal.css");
			// }

					include("plugins/modernizr.js");



			function include(url){

					document.write('<script src="'+ url + '"></script>');

			}

			function includeCss(href){

					var href = '<link rel="stylesheet" media="screen" href="' + href +'">';

					if($("[href*='style.css']").length){

						$("[href*='style.css']").before(href);

					}
					else{

						$("head").prepend(href);

					}

			}




		$(document).ready(function(){




			/* ------------------------------------------------
			Inputmask START
			------------------------------------------------ */

			if(mask.length){

				mask.inputmask({
					"mask": "+7 (999) 999-9999",
					'showMaskOnHover': false,
					"clearIncomplete": true,
					'oncomplete': function(){
						// console.log('Ввод завершен');
					},
					'onincomplete': function(){
						// console.log('Заполнено не до конца');
					},
					'oncleared': function(){
						// console.log('Очищено');
					}
				});

			}

			/* ------------------------------------------------
			Inputmask END
			------------------------------------------------ */


			/* ------------------------------------------------
			magnific-popup START
			------------------------------------------------ */

			if(magnificPopup.length){

				$('.js-lightbox').magnificPopup({
					type: 'image',
					tClose: 'Закрыть',
				});

				$('.js-lightbox-gallery').magnificPopup({
					type: 'image',
					delegate: 'a',
					tClose: 'Закрыть',
					gallery:{
					    enabled:true,
						tPrev: 'Назад', // title for left button
	  					tNext: 'Вперед', // title for right button
	  					tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
					}
				});

			}

			/* ------------------------------------------------
			magnific-popup END
			------------------------------------------------ */


			/* ------------------------------------------------
			FORMSTYLER START
			------------------------------------------------ */

					if (styler.length){
						styler.styler({
							selectSmartPositioning: true
						});
					}

			/* ------------------------------------------------
			FORMSTYLER END
			------------------------------------------------ */

			/* ------------------------------------------------
			slick start
			------------------------------------------------ */
					if (slick.length){

						$('.slider-for').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							fade: true,
							asNavFor: '.slider-nav',
							responsive: [

							    {
							      breakpoint: 480,
							      settings: {
							      	centerMode: true,
							        slidesToShow: 1
							      }
							    }

							]

						});
						$('.slider-nav').slick({
							slidesToShow: 2,
							slidesToScroll: 1,
							asNavFor: '.slider-for',
							dots: false,
							centerMode: false,
							variableWidth: true,
							focusOnSelect: true,

							responsive: [

							    {
							      breakpoint: 480,
							      settings: {
							      	variableWidth: false,
							      	centerMode: true,
							        slidesToShow: 1
							      }
							    }

							]


						});



					}
			/* ------------------------------------------------
			slick END
			------------------------------------------------ */



			/* ------------------------------------------------
			OWL START
			------------------------------------------------ */

					if(owl.length){

						if(owl.hasClass('js-carousel')){

							$(".js-carousel").owlCarousel({
								loop:true,
								autoplay:true,
							    autoplayTimeout:5000,
							    autoplayHoverPause:true,
								smartSpeed:1000,
								nav: true,
								dots:false,
					            navText: [ '', '' ],
					            responsive:{
							        0:{items:1},
							        480:{items:2},
							        576:{items:3},
							        768:{items:4},
							        1110:{items:5}
							    }
							});

						}

					}

			/* ------------------------------------------------
			OWL END
			------------------------------------------------ */




			/* ------------------------------------------------
			POPUP START
			------------------------------------------------ */

					if(popup.length){
						popup.on('click',function(){
						    var modal = $(this).data("popup");
						    $(modal).arcticmodal();
						});
					};

			/* ------------------------------------------------
			POPUP END
			------------------------------------------------ */




		});


		$(window).load(function(){


			$('#request_popup').arcticmodal();

		});




//  /*================================================>
//                                 >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  INCLUDE AND INITIALIZE Plugins END    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//  <================================================
