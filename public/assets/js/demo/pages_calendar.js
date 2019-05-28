/*
 * pages_calendar.js
 *
 * Demo JavaScript used on dashboard and calendar-page.
 */

"use strict";

$(document).ready(function(){




	init();
	initEvents();

	function Geter(id){
		$.ajax({
			type:'get',
			url:'getInfo?idMa='+id,
			success:function(data){
				var value = data.type+' serie n° '+data.mat;
				$('#matCible').val(value);
				$('#addMaint').find('button[type="submit"]').attr('disabled',false);
				$('a[href="#tab_feed_2"]').tab('show');
			}
		});
	}

	poulate_Select();

	function poulate_Select(){
		$.ajax({
			type:'get',
			url:'getPrest',
			success:function(data){
				$.each(data,function(index,ind){
					$('#traitant').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
				});
			}
		});
	}

	$(document).on('submit','#addMaint',function(e){
		e.preventDefault();
			$('.traitant').html("");
			$('.dmain').html("");
			$('.cout').html("");

			$('#traitant').removeClass('has-error').parent().removeClass('has-error');
			$('#dmain').parent().parent().removeClass('has-error');
			$('#cout').parent().removeClass('has-error');
		$.ajax({
			type:'post',
			url:$(this).attr('action'),
			data:$(this).serialize(),
			success:function(data){
				if(data.errors){
						if(data.errors.prestataire){
							$('#traitant').addClass('has-error').parent().addClass('has-error');
							$('.traitant').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.prestataire[0]+'</i>');
						}
						if(data.errors.dateMaintenance){
							$('#dmain').parent().parent().addClass('has-error');
							$('.dmain').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateMaintenance[0]+'</i>');
						}
						if(data.errors.cout){
							$('#cout').parent().addClass('has-error');
							$('.cout').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.cout[0]+'</i>');
						}
					}else{
						$('#resetf').trigger('click');
						initEvents();
						alerter();
					}
			}
		});
	});




	function trans(){
		$('input[name="id_mat"]').val("");
			$('#matCible').val("");
			$('.traitant').html("");
			$('.dmain').html("");
			$('#dmain').val("");
			$('#obs').val("");
			$('#cout').val("");
			$('.cout').html("");

			$('#traitant').removeClass('has-error').parent().removeClass('has-error');
			$('#dmain').parent().parent().removeClass('has-error');
			$('#cout').parent().removeClass('has-error');

			$('#s2id_traitant .select2-choice > .select2-chosen').html("Selectionner");
			$('#traitant').val('0');
			$('#addMaint').find('button[type="submit"]').attr('disabled',true);
	}

	$(document).on('click','#resetf',function(e){
		e.preventDefault();
			trans();
			$('a[href="#tab_feed_1"]').tab('show');
	});

	alerter();

	function alerter(){
		$.ajax({
			type:'get',
			url:'getAlert',
			success:function(data){
				$('.contentMaint').empty();
				$('.contAlert').empty();
				$.each(data.mainte,function(index,ind){
					$('.contentMaint').append('<li class="hoverable">'+
						'<a data-id="'+ind.id_m+'" id="mnt" href="javascript:void(0);">'+
						'<div class="col1">'+
							'<div class="content">'+
								'<div class="content-col1">'+
									'<div class="label label-'+ind.labl+'"><i class="icon-'+ind.icon+'"></i></div>'+
								'</div>'+
								'<div class="content-col2">'+
									'<div class="desc">'+ind.titre+'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col2">'+
							'<div class="date">'+ind.maint+'</div>'+
						'</div>'+
					'</a>'+
				'</li>');
				});
				$.each(data.alerte,function(index,ind){
					$('.contAlert').append('<li class="hoverable">'+
						'<a data-id="'+ind.id_m+'" id="mnt" href="javascript:void(0);">'+
						'<div class="col1">'+
							'<div class="content">'+
								'<div class="content-col1">'+
									'<div class="label label-'+ind.labl+'"><i class="icon-'+ind.icon+'"></i></div>'+
								'</div>'+
								'<div class="content-col2">'+
									'<div class="desc">'+ind.titre+'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col2">'+
							'<div class="date">'+ind.maint+'</div>'+
						'</div>'+
					'</a>'+
				'</li>');
				});
			}
		})
	}

	function init(){
		$('#calendar').fullCalendar({
		disableDragging: true,
		header: {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'},
		editable: false,
		events: {},
		eventRender: function (event, element) {
    	element.find('.fc-event-title').html(event.title);
		}
		,eventClick:function(data,event){
	        var idm=data.id;
	        trans();
	        $('input[name="id_mat"]').val(idm);
	        Geter(idm);
		       
      	},eventMouseover:function(data,event,view)
      	{
      		var tooltip = '<div class="tooltiptopicevent"'+
      		'style="font-size:12px;width:auto;height:auto;background:#fcf8e3;position:absolute;z-index:10001;'+
      		'padding:10px 10px 10px 10px ;  line-height: 170%;border-radius:5px;border:1px solid #ddd;">'
      		  + data.title + '</br>' + data.description
      		  + '</div>';

      		  $("body").append(tooltip);
            	$(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltiptopicevent').fadeIn('500');
                $('.tooltiptopicevent').fadeTo('10', 1.9);
            	}).mousemove(function (e) {
                $('.tooltiptopicevent').css('top', e.pageY + 10);
                $('.tooltiptopicevent').css('left', e.pageX + 20);
            });
      	},eventMouseout: function (data, event, view) {
            $(this).css('z-index', 8);
            $('.tooltiptopicevent').remove();
        }
	});
	}

	function initEvents()
    {
      		$.ajax({
	        type:'get',
	        url:'calendar',
	        success:function(event){
	            $('#calendar').fullCalendar('removeEvents');
	            $('#calendar').fullCalendar('addEventSource',event);
	            $('#calendar').fullCalendar('rerenderEvents');
        }
      });
    }

    $(document).on('click','#mnt',function(e){
    	e.preventDefault();
    	var idm = $(this).data('id');
    	$('input[name="id_mat"]').val(idm);
	        Geter(idm);
    });

    $(document).on('click','a[href="#tab_feed_1"],a[href="#tab_feed_3"]',function(){
    		trans();		
    });
	/*

	[{
				title: 'All Day Event',
				start: '2019-01-02', 
				backgroundColor: App.getLayoutColorCode('yellow')
			}, {
				title: 'Long Event',
				start: new Date(y, m, d - 5),
				end: new Date(y, m, d - 2),
				backgroundColor: App.getLayoutColorCode('green')
			}, {
				title: 'Repeating Event',
				start: new Date(y, m, d - 3, 16, 0),
				allDay: false,
				backgroundColor: App.getLayoutColorCode('red')
			}, {
				title: 'Repeating Event',
				start: new Date(y, m, d + 4, 16, 0),
				allDay: false,
				backgroundColor: App.getLayoutColorCode('green')
			}, {
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false,
			}, {
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				backgroundColor: App.getLayoutColorCode('grey'),
				allDay: false,
			}, {
				title: 'Birthday Party',
				start: new Date(y, m, d + 1, 19, 0),
				end: new Date(y, m, d + 1, 22, 30),
				backgroundColor: App.getLayoutColorCode('purple'),
				allDay: false,
			}, {
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				backgroundColor: App.getLayoutColorCode('yellow'),
				url: 'http://google.com/',
			}
		]
	*/

	/*function init2(){
		$('#calendar').fullCalendar({
		disableDragging: true,
		header: h,
		editable: true,
		events: [{
				title: 'All Day Event',
				start: new Date(y, m, 1),
				backgroundColor: App.getLayoutColorCode('yellow')
			}, {
				title: 'Long Event',
				start: new Date(y, m, d - 5),
				end: new Date(y, m, d - 2),
				backgroundColor: App.getLayoutColorCode('green')
			}, {
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				backgroundColor: App.getLayoutColorCode('yellow'),
				url: 'http://google.com/',
			}
		]
	});
	}*/

	
	



});