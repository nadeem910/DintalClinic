  $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd",minDate: 0});
		//Showing the current day treatments
		getTreatmentsForDay($("#datepicker").val()==''? $.datepicker.formatDate('yy-mm-dd', new Date()):$("#datepicker").val());
		
		//if date picker is changed
		$(document).on('change',"#datepicker",function(){
			getTreatmentsForDay($("#datepicker").val()==''? $.datepicker.formatDate('yy-mm-dd', new Date()):$("#datepicker").val());
		});
	  
		//Function that gets treatments for the specidic date
		function getTreatmentsForDay(day)
		{
			$("#datepicker").val(day);//Setting the datepicker if we haven't chosen a date
			
			$.post('classes/TreatmentHandler.php',{'show_treatments':day},function(data){			
				if(data=='fail')//If the user entered a wrong format
					alert('פורמט תאריך שגוי');
				else	
					$('.treatments').html(data);
			});
		}
		
		//Sending an email to bituah company
		$(document).on('click','.send_mail',function(){
			this_id=$(this);
			
			this_id.next().show('slow');//Showing the loading image
		
			$.post('classes/TreatmentHandler.php',{'send_bituah':1,'date':this_id.attr('data-date'),'treatment':this_id.attr('data-treatment'),
			'email':this_id.attr('data-email'),'id':this_id.attr('data-id')}
			,function(data){		
				this_id.next().hide('slow');//Hiding the loading image
				
				if(data=='fail')//If the user entered a wrong format
					alert("לא ניתן לשלוח אימייל לחברת הביטוח");
				else	
					alert("אימייל חדש נשלח לחברת הביטוח");
			});
		});