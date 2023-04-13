$(document).ready(function(){


	$(".phone-mask").mask("+7(999)999-99-99");
    //$('.carousel').carousel();
	if ($('.magic').length) {
		if ($(window).width() > 1024) {
			var controller = new ScrollMagic.Controller();

			// create a scene

			var tween1 = new TimelineMax({})
				.add(TweenMax.from('.op-item', 1.4, {
					opacity: 1
				}))
				.add(TweenMax.to('.op-item', 1.4, {
					opacity: 0
				}))
				.add(TweenMax.to('.s-desc__left', 5, {
					y: 0,
					opacity: 1
				}))
				.add(TweenMax.to('.s-desc__right', 5, {
					y: 0,
					opacity: 1
				}))
				.add(TweenMax.to('.s-desc__left,.s-desc__right', 4, {
					y: -400,
					opacity: 0
				}))
				.add(TweenMax.to('.s-desc__b-left', 4, {
					y: 0,
					opacity: 1
				}))
				.add(TweenMax.to('.s-desc__b-right', 4, {
					y: 0,
					opacity: 1
				}))
			new ScrollMagic.Scene({
					duration: 4000, // the scene should last for a scroll distance of 100px
					offset: 100 // start this scene after scrolling for 50px
				})
				.setTween(tween1)
				.setPin(".magic") // pins the element for the the scene's duration
				.addTo(controller);

		}
	}
	
    $(document).on('click', '.select-widget__attribute', function(e){
		$('.card-price').html('');
		//$(this).find('.puck-select__price').clone().appendTo('.card-price');
		$('.card-price').html($('.puck-select__price').html());
	});
	$(document).on('click', '.contacts-map-nav__item', function(e){
		$('.contacts-map-nav__item').removeClass('active');
		$(this).addClass('active');
	});
	
	
	$(document).on('click', '.checkboxing', function() {
		if($(".checkboxing").hasClass("active")){
			setTimeout(function(){
				$(".checkboxing").removeClass("active");
			}, 50);
		}
		else {
			setTimeout(function(){
				$(".checkboxing").addClass("active");
			}, 50);
		}
	});
	$('a.branding-nav__link').click(function() { return false; });
        
	$(document).on('click', '.order-submit', function() {
		$('.detail-order__item').each(function( index ) {
			var rel = $(this).attr('det');
			var q = $('[det = '+rel+']').find('.only-numb').val();
			var w = $('[rel = '+rel+']').find('img').attr('src');
			var n = $('[rel = '+rel+']').siblings('.set-item__title').html();
			$('.det_pay').append("<div class='col col--sm-4 col--xs-6'><span class='set-item__content popup__set-item'><span class='set-item__pic'><span class='set-item__counter'>"+q+"</span><img = src='"+w+"'></span><span class='set-item__title'>"+n+"</span></span></div>");
			$('.popup-summ__price').html($('.order-summ__price').html());
		});
		
	});
	$('.popup-summ .counter__btn_plus').on('click', function(){
		var sum = $(this).siblings($('.only-numb').val());
		var sum_price = $('.order-summ__price .prices_all').html();
		console.log(1111111);	
		$(this).siblings('.only-numb').val(sum+1);
		$('.popup-summ__price .prices_all').html(sum_price*(sum+1));
	});
	$('.popup-summ .counter__btn_minus').on('click', function(){
		var sum = $(this).siblings($('.only-numb').val());
		var sum_price = $('.order-summ__price .prices_all').html();
		$(this).siblings('.only-numb').val(sum-1);
		$('.popup-summ__price .prices_all').html(sum_price*(sum-1));
	});
	$(document).on('click', '.mfp-close', function() {
		$('.det_pay').html('');
	});
	
	$("#callForm").submit(function(event) {
 
        if ($('#name').val() == "")
            {
                $('#bthrow_error_name').fadeIn(1000).html('Представьтесь, пожалуйста.');
            }
        else if ($('#phone').val() == "")
            {
                $('#bthrow_error_name').empty();
                $('#bthrow_error_phone').fadeIn(1000).html('Как с Вами связаться?');
            }
        else
            {
                var postForm = {
                    'name'  : $('#name').val(),
                    'phone'  : $('#phone').val()
                };
 
                $.ajax({
                    type        : 'POST',
                    url         : 'svayz.php',
                    data        : postForm,
                    dataType    : 'json',
                    success     : function(data)
                        {
                            if (!data.success)
                                {
                                    if (data.errors.name)
                                        {
                                            $('.throw_error').fadeIn(1000).html(data.errors.name);
                                        }
                                }
                            else
                                {
                                    $('#callForm').fadeIn(1000).html('<p>' + data.posted + '</p>');
                                }
                        }
                });
            }
 
        event.preventDefault();
 
    });
	
	
	
    $('.filters_form').change(function(){
	
        var formData = new FormData($(".filters_form")[0]);
		//$('.list-view').html('');
        $.ajax({
            url: '/ajax/view',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                console.log(data);
                $('.list-view').html(data);
                //$('.form-control-item-page').find('option').remove()
                //$.each(data, function(i, value) {
                //    $('.form-control-item-page').append($('<option>').text(value).attr('value', i));
                //});
           },
            error: function(){
                $('.list-view').html('Ничего не найдено по выбранным характеристикам');
            }
        });
    });
});
