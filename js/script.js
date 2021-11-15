 
/*  ===== РАСЧЕТ ДАТЫ ПРИБЫТИЯ В РЕГИОН =====  */

$(document).ready(function(){

	$('select[name="region"], input[name="departureDate"]').on('change',function() {

			var duration 		=	$('select[name="region"] option:selected').data('duration');
			var departureDate 	=	$('input[name="departureDate"]').val();

			if(duration && departureDate){

				$.ajax({
					type: 'post',
					url: '/ajax/getArrivalDate.php',
					data: {
						'duration': duration,
						'departureDate': departureDate
					},
					success:function(data){
						if(data) {
							$('input[name="arrivalDate"]').val(data);
						} else {
							$('input[name="arrivalDate"]').val('');
						}
					}
				});
				
			}
			
	});

});

/*  ===== ОТПРАВЛЕНИЕ ДАННЫХ С ФОРМЫ =====  */

$('form#inputSchedule').submit(function(){
	var error = false;
	$('.error').hide();
	var region = $('#inputSchedule select[name="region"]').val();
	if(!region){error = true; $('#region_error').show();}
	var departureDate = $('#inputSchedule input[name="departureDate"]').val();
	if(!departureDate){error = true; $('#departureDate_error').show();}
	var courier = $('#inputSchedule select[name="courier"]').val();
	if(!courier){error = true; $('#courier_error').show();}
	var arrivalDate = $('#inputSchedule input[name="arrivalDate"]').val();
	if(!arrivalDate){error = true; $('#arrivalDate_error').show();}
	if(!error){
		$.ajax({
			type: 'POST',
			url: '/ajax/fillSchedule.php',
			dataType: 'json',
			data: {
				"region": region,
				"departureDate": departureDate,
				"courier": courier,
				"arrivalDate": arrivalDate
			},
			success: function(data){
				if(data == '1') {
					$('.hf, .sf').toggle();
					$('#inputSchedule')[0].reset();
					setTimeout(function () {
						$('.sf, .hf').toggle();
					}, 2000);
				} else if (data == '2') {
					alert('Курьер занят');
					$('#inputSchedule')[0].reset();
				} 
				else {
					alert('Что-то пошло не так..');
				}
			}
		});
	}
	return false;
});

/*  ===== ВВОД ДАТЫ И ВРЕМЕНИ =====  */

$('#selectDate').datetimepicker({
	timepicker:false,
	closeOnDateSelect : true,
	format:'d.m.Y',
	dayOfWeekStart: 1,
	scrollMonth : false,
	scrollInput : false
});

$('#departureDate').datetimepicker({
	timepicker:false,
	closeOnDateSelect : true,
	format:'d.m.Y',
	dayOfWeekStart: 1,
	scrollMonth : false,
	scrollInput : false
});

$('#arrivalDate').datetimepicker({
	timepicker:false,
	closeOnDateSelect : true,
	format:'d.m.Y',
	dayOfWeekStart: 1,
	scrollMonth : false,
	scrollInput : false
});


jQuery.datetimepicker.setLocale('ru');


/*  ===== ФИЛЬТР  =====  */

$(document).ready(function() {
	
	filter($('input[name="selectDate"]').val());
		
	$('form#showSchedule').on('change', function(){

		var data = $('input[name="selectDate"]').val();
		filter(data);
		return false;
	});
});

function filter(data){
	$.ajax({
		type: 'POST',
		url: '/ajax/schedule.php',
		dataType: 'html',
		cache: false,
		data: {
			'data': data
		},
		success: function(res) {
			if (res) {
				$('.result').html(res);
			} else {
				alert('Ошибка');
			}
		}
	});
}