
//Getting all the existing treatments
$.post('classes/TreatmentHandler.php',{'get_treatments':1},function(data){
	$('.treatments').html(data);
});

//Getting the treatments as select element options
$.post('classes/TreatmentHandler.php',{'get_treatments_list':1},function(data){				
	$('#treatmentList').html(data);
});

//Getting all the existing companies
$.post('classes/Companies.php',{'get_companies_list':1},function(data){			
	$('#bituahList').html(data);
});

//Sign treatment Calendar
$(document).on('click','#calendar',function(){
	$('#datetime').focus();
});	

//Delete treatment calendar
$(document).on('click','#del_calendar',function(){
	$('#del_datetime').focus();
});		

//Showing the specific treatment information
$(document).on('click','.treatment_links',function(){
	$.post('classes/TreatmentHandler.php',{'get_treatment_info':$(this).attr('data-id')},function(data){
		$('.treatmentInfoModal').html(data);
	});
});		

//Adding a client
$(document).on('click','#sendClient',function(){
	$('.loading').show('slow');
	
	$.post('classes/Client.php',{'add_client':1,'name':$('#firstname').val(),
	'lname':$('#lastname').val(),'email':$('#email').val(),'phone':$('#phone').val(),
	'treatment':$('#treatmentList option:selected').val(),'datetime':$('#datetime').val(),'company':$('#bituahList option:selected').val()},
	function(data){	
		$('.loading').hide('slow');
		if(data=='success')//If the treatment was signed in successfully
		{
			alert("נרשמת לטיפול בהצלחה");
			$('.signErr').html('').hide();
			
			//Clear all inputs
			$('#firstname').val('');
			$('#lastname').val('');
			$('#email').val('');
			$('#phone').val('');
			$('#treatmentList').val('');
			$('#bituahList').val('');
			$('#datetime').val('');
		}
		else
		{
			$('.signErr').html(data).show();
		}						
	});
});


//Sending a new suggestion
$(document).on('click','#sendSuggestion',function(){
	$.post('classes/Suggestions.php',{'add_suggestion':1,'firstname':$('#contactFname').val(),'lastname':$('#contactLname').val(),'content':$('#suggestionsText').val()},function(data){
		if(data=='success')
		{
			alert('ההמלצה שלך נשלחה בהצלחה.');
			$('.suggErr').html('').hide();
			
			$('#contactFname').val('');
			$('#contactLname').val('');
			$('#suggestionsText').val('');
		}
		else
			$('.suggErr').html(data).show();
	});
});

//Deleting the specific treatment
$(document).on('click','#delTreatment',function(){
	$('.loading2').show('slow');
	
	$.post('classes/TreatmentHandler.php',{'del_treatment':1,'email':$('#del_email').val(),'treatment_date':$('#del_datetime option:selected').val()},function(data){
		$('.loading2').hide('slow');
		
		
		if(data=='טיפולך בוטל בהצלחה' || data=="טיפולך בוטל בהצלחה,אבל אין באפשרתנו לשלוח אישור ביטול באימייל ")//If the treatment was canceled successfully
		{
			$('#del_email').val('');
			$('#del_datetime').val('').hide();
		}
		
		alert(data);
	});
});

$(document).ready(function(){
	//When the email is changed
	$(document).on('keyup','#del_email',function(){
		$('.loading2').show('slow');
		    $.post('classes/TreatmentHandler.php',{'show_my_treatments':$('#del_email').val()},function(data){	
				$('.loading2').hide('slow');
						
			    if(data!='no')
				$('#del_datetime').show().html(data);
		});
	});

				 $(".form_datetime").datetimepicker({
					 startDate: new Date(),
					 format: 'hh:ii dd/mm/yyyy',
					 todayBtn: true,
					 hoursDisabled: '0,1,2,3,4,5,6,7,21,22,23',
					 autoclose:true
					 });	
});


