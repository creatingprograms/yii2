$(document).ready(function(){
	$('.update_link').click(function(e){
	   e.preventDefault();      
	   $('#modal-add-user').modal('show').find('.modal-body').load($(this).attr('href'));  
	   $('#modal-add-event').modal('show').find('.modal-body').load($(this).attr('href')); 
	   $('#modal-add-object').modal('show').find('.modal-body').load($(this).attr('href'));  
	});

	function selectCustom(){
		var $this = $(this), numberOfOptions = $(this).children('option').length;

		$this.addClass('select-hidden');
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="select-styled"></div>');

		var $styledSelect = $this.next('div.select-styled');
		$styledSelect.text($this.children('option').eq(0).text());

		var $list = $('<ul />', {
			'class': 'select-options'
		}).insertAfter($styledSelect);

		for (var i = 0; i < numberOfOptions; i++) {
			$('<li />', {
				text: $this.children('option').eq(i).text(),
				rel: $this.children('option').eq(i).val()
			}).appendTo($list);
		}

		var $listItems = $list.children('li');

		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.select-styled.active').not(this).each(function(){
				$(this).removeClass('active').next('ul.select-options').hide();
			});
			$(this).toggleClass('active').next('ul.select-options').toggle();
		});

		$listItems.click(function(e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass('active');
			$this.val($(this).attr('rel'));
			$list.hide();
			if($(this).parents('.form-group').hasClass('field-user-type')){
				if($(this).attr('rel')=='2'){
					$('.type_block').removeClass('d-none');
				}else{
					$('.type_block').addClass('d-none');
				}
			}
		});

		$(document).click(function() {
			$styledSelect.removeClass('active');
			$list.hide();
		});
	};

	$('.btn-user-add').click(function(e){
	    e.preventDefault();


        var ev_date = {};
        if ($(this).data('role')){
            ev_date['role'] = $(this).data('role');
        }

        $.ajax({
            type        : 'GET',
            url         : '/for_admin/user/create',
            data        : ev_date,
            //dataType    : 'json',
            success     : function(data)
                {
                    $('body').css('overflow', 'hidden');
                    $('#modal-add-user').modal('show').find('.modal-body').html(data);
                    $('.modal-body').on('click', '#user-active', function(){
                        if($(this).prop('checked')){
                            $('.is_active').html('АКТИВНЫЙ');
                        }else{
                            $('.is_active').html('НЕ АКТИВНЫЙ');
                        }
                    });
                    $('select').each(selectCustom);
                    $('.modal-body').on('click', '.input--btn-delete', function(e){
                        e.preventDefault();
                        $('#user-password').val('');
                    });
                    $('.modal-body').on('click', '.input--btn-refresh', function(e){
                        e.preventDefault();
                        var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        res = '';
                        for (var i = 0, n = charset.length; i < length; ++i) {
                            res += charset.charAt(Math.floor(Math.random() * n));
                        }
                        $('#user-password').val(res);
                    });
                    $("input[type=phone]").mask("+7 (999) 999-99-99", {autoclear: false});
                }
        });
	   //$('#modal-add-user').modal('show').find('.modal-body').load($(this).attr('href'));  
	});
	$('.form-filter-object-btn').click(function(e){
		e.preventDefault();  	
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		var ev_date = {'object': $('#project-id').val(), 'act': $(this).attr('act'), csrfParam : csrfToken};
		$.ajax({
			type        : 'POST',
			url         : '/for_admin/event/evobject',
			data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
					
					var orgSource = calendar.getEventSources();
					orgSource[0].remove();
					calendar.addEventSource(data);
					//calendar.FullCalendar('updateEvents', data);
					//$('#calendar').html(data);
				}
		});
	});
	$('.close').click(function(e){
		$('#modal-add-user').modal('hide');
		$('#modal-add-object').modal('hide');
		$('#modal-add-event').modal('hide');
		$('#modal-doc-event').modal('hide');
		$('#modal-list-event').modal('hide');
		$('#modal-view-event').modal('hide');
		$('body').css('overflow', '');
	});
	$('.btn-object-add').click(function(e){
	   e.preventDefault();      
	   $('#modal-add-object').modal('show').find('.modal-body').load($(this).attr('href'));
		$.ajax({
			type        : 'POST',
			url         : '/for_admin/project/create',
			//data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
					$('body').css('overflow', 'hidden');
					$('#modal-add-object').modal('show').find('.modal-body').html(data);
					$('select').each(selectCustom);
				}
		});
	});
	$('.btn-event-add').click(function(e){
	   e.preventDefault();      
	   $('#modal-add-object').modal('show').find('.modal-body').load($(this).attr('href'));
		$.ajax({
			type        : 'POST',
			url         : '/for_admin/event/create',
			//data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
					$('body').css('overflow', 'hidden');
					$('#modal-add-event').modal('show').find('.modal-body').html(data);
					$('select').each(selectCustom);
					$("#event-created_at").mask("9999-99-99", {placeholder: 'YYYY-MM-DD' });
					$("#event-created_at").datepicker({
						minDate: 0,
						dateFormat: 'yy-mm-dd'
					});
				}
		});
	});
	$( "#document-upload_doc" ).change(function() {
		 $(".input__file-label").html($(this).val());
	});
    $('.btn--notice').on('click', function (e) {
        e.stopPropagation;
        $('.notices').toggleClass('is-show');
    });
    $('.header__person').on('click', function (e) {
		e.stopPropagation;
        $('.header__person').toggleClass('is-active');
    });
    $(document).mouseup(function (e) {
        if (!$('.notices').is(e.target) && $('.notices').has(e.target).length === 0 && !$('.btn--notice').is(e.target)) {
            $('.notices').removeClass('is-show');
        }
    });
    $(document).mouseup(function (e) {
        if (!$('.header__popup').is(e.target) && $('.header__popup').has(e.target).length === 0 && !$('.btn--person').is(e.target)) {
            $('.header__person').removeClass('is-active');
        }
    });
	
	$('.switch input').change(function() {
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		var ev_date = {'date': $(this).prop('checked'), 'id': $(this).attr('id'), csrfParam : csrfToken};
		$.ajax({
			type        : 'POST',
			url         : '/for_admin/user/active',
			data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
				}
		});
	});
	
	$('.act_matching').click(function(e){
		e.preventDefault();   
		var csrfToken = $('meta[name="csrf-token"]').attr("content");
		var ev_date = {'id': $(this).attr('id'), 'act': $(this).attr('act'), csrfParam : csrfToken};
		$.ajax({
			type        : 'GET',
			url         : '/for_admin/notification/matching',
			data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
					$('.notification-form').html(data);
				}
		});
	});

    $(document).on('click', '.act_matching_with_comment', function(e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var ev_date = {'id': $(this).attr('id'), 'act': $(this).attr('act'), 'comment': $('#comment--not--accepted').val(), csrfParam : csrfToken};
		$.ajax({
			type        : 'GET',
			url         : '/for_admin/notification/matching',
			data        : ev_date,
			//dataType    : 'json',
			success     : function(data)
				{
					$('#modal-view-event').modal('hide');
					//$('.notification-form').html(data);
				}
		});
    })

	$('.summary_act').html($('.summary').html());
	if(typeof events !== "undefined"){
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			locale: 'ru',
			initialView: 'dayGridMonth',
			initialDate: new Date(),
			selectable: true,
			
			eventSources : [
				{
					events : events,
				}
			],

			titleFormat: {
				month: 'long'
			},

			headerToolbar: {
				left: '',
				center: 'prev title next',
				right: ''
			},

			dateClick: function(date) {

				var ev_date = {'date': date.dateStr};

				$.ajax({
					type        : 'POST',
					url         : '/for_admin/event/listev',
					data        : ev_date,
					//dataType    : 'json',
					success     : function(data)
						{
							$('#modal-list-event').hide();
							$('body').css('overflow', 'hidden');
							$('#modal-list-event').modal('show').find('.modal-body').html(data);

							//$('select').each(selectCustom);
							$('.btn-close').on('click', function () {
							   $('#modal-list-event').modal('hide');
							   $('body').css('overflow', '');
							});
							$('.add_event').on('click', function (e) {
								e.preventDefault();
								$.ajax({
									type        : 'POST',
									url         : '/for_admin/event/create',
									//data        : ev_date,
									//dataType    : 'json',
									success     : function(data)
									{
										$('.modal-backdrop').remove();
										$('#modal-list-event').modal('hide');
										$('body').css('overflow', 'hidden');
										$('#modal-add-event').modal('show').find('.modal-body').html(data);
										$('#event-created_at').val($('.event_date_data').html());
										$('#event-created_at').addClass('has-content');
										$('select').each(selectCustom);
										$('.btn-close').on('click', function () {
										   $('#modal-add-event').modal('hide');
										   $('#modal-list-event').modal('hide');
										   $('body').css('overflow', '');
										});
										
										$("#event-created_at").datepicker({
											minDate: 0,
											dateFormat: 'yy-mm-dd'
										});
										$("#event-startdate_at").datepicker({
											dateFormat: 'yy-mm-dd'
										});
										
										$('.field-event-user_id .select-options li').on('click', function () {
											user_id = {'user': $(this).attr('rel')};
											$.ajax({
												type        : 'POST',
												url         : '/for_admin/event/addproject',
												data        : user_id,
												//dataType    : 'json',
												success     : function(data)
													{
														if(data[0]['count'] == 1){
															var vl = data[0]['project'];
															$("#event-project_id option[value="+vl+"]").prop("selected", true);
															var nm = data[0]['name'];
															$('.field-event-project_id div.select-styled').html(nm);
														}else{
															$('.field-event-project_id div.select-styled').html('Выберите и начните вводить');
														}
														$('.field-event-project_id .select-options').html(data[0]['list']);
														console.log($("#event-project_id").val());
														$("#event-project_id").html(data[0]['options']);
														$('.select-options li').on('click', function () {
															console.log($(this).attr('rel'));
															var vl = $(this).attr('rel');
															$("#event-project_id option[value="+vl+"]").prop("selected", true);
															var nm = $(this).html();
															$('.field-event-project_id div.select-styled').html(nm);
															console.log($("#event-project_id option[value="+vl+"]").val());
														});
													}
											});
										});
									}
								});
							});
							
							
							$('.view_event').on('click', function (e) {
								e.preventDefault();
								var ev_date = {'date': $(this).attr('id')};
								$.ajax({
									type        : 'POST',
									url         : '/for_admin/event/viewpc',
									data        : ev_date,
									//dataType    : 'json',
									success     : function(data)
										{
											
											$('.modal-backdrop').remove();
											$('#modal-list-event').modal('hide');
											$('body').css('overflow', 'hidden');
											$('#modal-view-event').modal('show').find('.modal-body').html(data);
											$('.btn-close').on('click', function () {
											   $('#modal-view-event').modal('hide');
											   $('#modal-list-event').modal('hide');
											   $('body').css('overflow', '');
											});
											$('.act_matching').click(function(e){
												e.preventDefault();   
												var id_date = $(this).attr('id');
												var act_date = $(this).attr('act');
												$.ajax({
													type        : 'GET',
													url         : '/for_admin/notification/matching?id='+id_date+'&act='+act_date,
													//data        : ev_date,
													//dataType    : 'json',
													success     : function(data)
														{
															$('.calendar-modal').html(data);
														}
												});
											});
											$('.doc_down').click(function(e){
												e.preventDefault();
												var ev_date = $(this).attr('id');
												$.ajax({
													type        : 'GET',
													url         : '/for_admin/document/update?id='+ev_date,
													success     : function(data)
														{
															$('#modal-add-event').remove();
															$('body').css('overflow', 'hidden');
															$('#modal-doc-event').modal('show').find('.modal-body').html(data);
															$('.btn-close').on('click', function () {
															   $('#modal-doc-event').modal('hide');
															   $('body').css('overflow', '');
															});
															$( "#document-upload_doc" ).change(function(e) {
																$(".input__file-label").html(e.target.files[0].name);
															});
														}
												});
											});
										}
								});
							});
						}
				});
			},

			eventClick: function(info) {
			//	var ev_date = {'date': info.event.id};
			//	if (window.matchMedia("(min-width: 992px)").matches) {
			////		$.ajax({
			//			type        : 'POST',
			//			url         : '/for_admin/event/viewpc',
			//			data        : ev_date,
						//dataType    : 'json',
			//			success     : function(data)
			//				{
			//					$('.calendar-modal').remove();
			//					info.el.innerHTML += data;
								/* Close click output */
			//					$(document).mouseup(function (e) {
			//						if (!$('.calendar-modal').is(e.target) && $('.calendar-modal').has(e.target).length === 0) {
			//							$('.calendar-modal').remove();
			//						}
			//					});
			//					$('.act_matching').click(function(e){
			//						e.preventDefault();   
			//						var id_date = $(this).attr('id');
			//						var act_date = $(this).attr('act');
			//						$.ajax({
			//							type        : 'GET',
			//							url         : '/for_admin/notification/matching?id='+id_date+'&act='+act_date,
										//data        : ev_date,
			//							//dataType    : 'json',
			//							success     : function(data)
			//								{
			//									$('.calendar-modal').html(data);
			//								}
			//						});
			//					});
			//					$('.doc_down').click(function(e){
			//						e.preventDefault();
			//						var ev_date = $(this).attr('id');
			//						$.ajax({
			//							type        : 'GET',
			//							url         : '/for_admin/document/update?id='+ev_date,
			//							success     : function(data)
			//								{
			//									$('#modal-add-event').remove();
			//									$('body').css('overflow', 'hidden');
			//									$('#modal-doc-event').modal('show').find('.modal-body').html(data);
			//									$('.btn-close').on('click', function () {
			//									   $('#modal-doc-event').modal('hide');
			//									   $('body').css('overflow', '');
			//									});
			//								}
			//						});
			//					});
			//				}
			//		});

			//	} else {
			//		$.ajax({
			//			type        : 'POST',
			//			url         : '/for_admin/event/viewpc',
			//			data        : ev_date,
						//dataType    : 'json',
			//			success     : function(data)
			//				{
			//					$('.calendar-modal').remove();
			//					$('.data-table').append(data)
			//				}
			//		});
			//	}
			},
			eventDidMount: function (event) {
				$(event.el).attr('ev_id', event.event.id)
			},
		});

		if (window.matchMedia("(min-width: 768px)").matches) {
			calendar.setOption('height', 650);
		} else {
			calendar.setOption('height', 450);
		}

		calendar.render();
	}
		
	$('.main-block').on('click', '.input--btn-refresh', function(e){	
		e.preventDefault();
		var length = 8,
		charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		res = '';
		for (var i = 0, n = charset.length; i < length; ++i) {
			res += charset.charAt(Math.floor(Math.random() * n));
		}
		$('#user-password').val(res);
	});			
		
	$('.form--search').on('click', '.active_checked', function(){
		if($('#usersearch-active').prop('checked')){
			$('input[name*="UserSearch[active]"]').remove();
			$('.btn--search').click();
		}else{
			$('.btn--search').click();
		}
	});
	$('.main-block').on('click', '.input--btn-delete', function(e){
		e.preventDefault();
		$('#user-password').val('');
	});
	$('.notices__item').on('click', '.notices__item-close-btn', function(e){
		e.preventDefault();
		var ev_date = {'id': $(this).parents('.notices__item').attr('not_id')};
		$.ajax({
			type        : 'POST',
			url         : '/for_admin/notification/remove',
			data        : ev_date,
			//dataType    : 'json',
			success     : function()
				{
					console.log(111111111);
				}
		});
		$(this).parents('.notices__item').remove();
		$('.btn--notice .count').html($('.notices__item').length)
	});
	
	$('.doc_down').click(function(e){
		e.preventDefault();
		var ev_date = $(this).attr('id');
		$.ajax({
			type        : 'GET',
			url         : '/for_admin/document/update?id='+ev_date,
			success     : function(data)
				{
					$('body').css('overflow', 'hidden');
					$('#modal-doc-event').modal('show').find('.modal-content').html(data);
					$('.btn-close').on('click', function () {
					   $('#modal-doc-event').modal('hide');
					   $('body').css('overflow', '');
					});
					$( "#document-upload_doc" ).change(function(e) {
						 //$(".input__file-label").html($(this).val());
							$(".input__file-label").html(e.target.files[0].name);
					});
					//$('.form__send .btn--accent').click(function(e){
					//	e.preventDefault();
					//	var formData = new FormData();
					//	formData.append('file', $("#document-upload_doc")[0].files[0]);
					//	console.log($("#document-upload_doc")[0].files[0]);
					//});
				}
		});
	});
	$('.delete_link').click(function(e){
		e.preventDefault();
		$('body').css('overflow', 'hidden');
		$('#modal-del-event').modal('show').find('.modal-body').html(
			"<p>Действительно ли вы хотите удалить пользователя: <br><b>"+$(this).parents('td').find('a').html()+"</b></p><a href="+$(this).attr('href')+" class='delete_link_yes btn btn-error'>Да</a><a class='no_del btn btn-success'>Нет</a> "
		
		);
		$('.btn-close').on('click', function () {
		   $('#modal-del-event').modal('hide');
		   $('body').css('overflow', '');
		});
		$('.no_del').on('click', function () {
		   $('#modal-del-event').modal('hide');
		   $('body').css('overflow', '');
		});
		var ob = $(this);
		$('.delete_link_yes').click(function(e){
			e.preventDefault();
			var ev_date = $(this).attr('href');
			$.ajax({
				type        : 'GET',
				url         : ev_date,
				success     : function(data)
					{
						$('body').css('overflow', 'hidden');
						$('#modal-del-event').modal('show').find('.modal-body').html(data);
						$('.btn-close').on('click', function () {
						   $('#modal-del-event').modal('hide');
						   $('body').css('overflow', '');
						});
						ob.parents('tr').remove();
					}
			});
		});
	});
	$('#project-id').on('select2:select', function(e){
		$('.form-filter-object-btn').click();
	});
    
	$('#user-type').change(function(e){
		console.log($(this).val());
		if($(this).val()=='2'){
			$('.ur_input').removeClass('d-none');
			$('.fis_input').addClass('d-none');
		}else{
			$('.ur_input').addClass('d-none');
			$('.fis_input').removeClass('d-none');
		}
	});
	
    $("input[type=phone]").mask("+7 (999) 999-99-99", {autoclear: false});
	
    // inn
    $(document).on("input", "#user-inn", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(document).on("input", "#user-ogrn", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(document).on("input", "#user-rs", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(document).on("input", "#user-ks", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(document).on("input", "#user-bik", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // not accepted
    $(document).on("click", ".not--accepted", function (e){
        e.preventDefault();
		$(this).addClass('btn--check');
		$(".act_matching").removeClass('btn--check');
        $(".not--accepted--reason").show("slow");
    });
	
	$('.select-options li').on('click', function () {
		if($(this).attr('rel') == "2"){
			console.log($(this).attr('rel'));
			$('.type_block').removeClass('d-none');
		}else{
			$('.type_block').addClass('d-none');
			$('.type_block input').val('');
		}
		
	});
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: 'Предыдущий',
		nextText: 'Следующий',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Не',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
	$("#event-created_at").mask("9999-99-99", {placeholder: 'YYYY-MM-DD' });
	$("#event-created_at").datepicker({
		minDate: 0,
		dateFormat: 'yy-mm-dd'
	});
	$("#event-startdate_at").datepicker({
		dateFormat: 'yy-mm-dd'
	});
	
	$('.filters .select-options li').on('click', function () {
		$('.filters .form-control options').eq($( this ).index()).click();
	});
	
	
	
	
	
	
	
	
	
	
	if(not){
		console.log($('.fc-daygrid-event[ev_id="'+not+'"]'));
		console.log('ev_id="'+not+'"');
		$('.fc-daygrid-event[ev_id="'+not+'"]').click();
		var ev_date = {'date': not};
		if (window.matchMedia("(min-width: 992px)").matches) {
			$.ajax({
				type        : 'POST',
				url         : '/for_admin/event/viewpc',
				data        : ev_date,
				//dataType    : 'json',
				success     : function(data)
					{
						$('.calendar-modal').remove();
						//$('#modal-doc-event').modal('show').find('.modal-content').html(data);
						$('#modal-view-event').modal('show').find('.modal-body').html(data);
						$('.doc_down').click(function(e){
							e.preventDefault();
							var ev_date = $(this).attr('id');
							$.ajax({
								type        : 'GET',
								url         : '/for_admin/document/update?id='+ev_date,
								success     : function(data)
									{
										$('body').css('overflow', 'hidden');
										$('#modal-doc-event').modal('show').find('.modal-content').html(data);
										$('.btn-close').on('click', function () {
										   $('#modal-doc-event').modal('hide');
										   $('body').css('overflow', '');
										});
										$( "#document-upload_doc" ).change(function(e) {
											$(".input__file-label").html(e.target.files[0].name);
										});
									}
							});
						});
						$('.act_matching').click(function(e){
							e.preventDefault();   
							var id_date = $(this).attr('id');
							var act_date = $(this).attr('act');
							$.ajax({
								type        : 'GET',
								url         : '/for_admin/notification/matching?id='+id_date+'&act='+act_date,
								//data        : ev_date,
								//dataType    : 'json',
								success     : function(data)
									{
										$('#modal-view-event').modal('hide');
										//$('.calendar-modal').html(data);
									}
							});
						});
						// Close click output /
						//$(document).mouseup(function (e) {
						//	if (!$('.calendar-modal-user').is(e.target) && $('.calendar-modal-user').has(e.target).length === 0) {
						//		$('#modal-doc-event').modal('hide')
					}
				});
		}
	}
			
			
	
			
			
});
