$(document).ready(function(){
	showDoctors();
	
	//Deleting the specific doctors
	$(document).on('click','.deleteDoctor',function(){
		$.post('classes/DoctorsHandler.php',{'delete_doctor':$(this).attr('data-id')},function(){
			showDoctors();
		});
	});
	
	//Searching for specific doctors
	$('#search_doctor').on('keyup',function(){ showDoctors($(this).val());
	});
	
	//Adding a new doctor's information
	$(document).on('click','.addBtn',function(){
		$.post('classes/DoctorsHandler.php',{'manage_doctor':0,'fullname':$('.addFullname').val(),
		'email':$('.addEmail').val(),'phone':$('.addPhone').val()},function(data){
			if(data=='success')//If added a new doctor successfully
			{
				$('#addModal').modal('toggle');
				showDoctors();
				$('.addErr').hide().html('');
			}
			else//If there was a problem
				$('.addErr').show().html(data);
		});
	});
	
	//Updating an existing doctor 
	$(document).on('click','.updateBtn',function(){
		$.post('classes/DoctorsHandler.php',{'manage_doctor':$(this).attr('data-id'),'fullname':$('.updateFullname').val(),
		'email':$('.updateEmail').val(),'phone':$('.updatePhone').val()},function(data){
			if(data=='success')//If added a new doctor successfully
			{
				$('#updateModal').modal('toggle');
				showDoctors();
				$('.updateErr').hide().html('');
			}
			else//If there was a problem
				$('.updateErr').show().html(data);
		});
	});
	
	//If clicked one of the update buttons(SELECT qyery)
	$(document).on('click','.editDoctor',function(){
		id=$(this).attr('data-id');
		$.post('classes/DoctorsHandler.php',{'get_by_id':id},function(data){
			$('.updateBtn').attr('data-id',id)
			$('.updateInfo').html(data);
		});
	});
	
});

//Showing all the existing doctors
function showDoctors(condition='')
{
	//Showing all the existing doctors
	$.post('classes/DoctorsHandler.php',{'show_doctors':1,'where':condition},function(data){
		$('.doctorsList').html(data);
	});
}