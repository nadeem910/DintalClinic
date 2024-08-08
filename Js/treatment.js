$(document).ready(function(){
	showTypes();
	
	//Deleting the specific Types
	$(document).on('click','.deleteType',function(){
		$.post('classes/TreatmentTypesHandler.php',{'delete_type':$(this).attr('data-id')},function(){
			showTypes();
		});
	});
	
	$('#search_type').on('keyup',function(){ showTypes($(this).val());
	});
	
	
	
	//Adding a new Type's information
	$(document).on('click','.addBtn',function(){
		$.post('classes/TreatmentTypesHandler.php',{'manage_type':0,'name':$('.addType').val(),
		'description':$('.addDescription').val(),'time':$('.addTime').val()},function(data){
			if(data=='success')//If added a new type successfully
			{
				$('#addModal').modal('toggle');
				showTypes();
				$('.addErr').hide().html('');
			}
			else//If there was a problem
				$('.addErr').show().html(data);
		});
	});
	
	//Updating an existing Type 
	$(document).on('click','.updateBtn',function(){
		$.post('classes/TreatmentTypesHandler.php',{'manage_type':$(this).attr('data-id'),'name':$('.updateType').val(),
		'description':$('.updateDescription').val(),'time':$('.updateTime').val()},function(data){
			if(data=='success')//If added a new Type successfully
			{
				$('#updateModal').modal('toggle');
				showTypes();
				$('.updateErr').hide().html('');
			}
			else//If there was a problem
				$('.updateErr').show().html(data);
		});
	});
	
	//If clicked one of the update buttons
	$(document).on('click','.editType',function(){
		id=$(this).attr('data-id');
		$.post('classes/TreatmentTypesHandler.php',{'get_by_id':id},function(data){
			$('.updateBtn').attr('data-id',id)
			$('.updateInfo').html(data);
		});
	});
	
});

//Showing all the existing Types
function showTypes(condition='')
{
	//Showing all the existing Types
	$.post('classes/TreatmentTypesHandler.php',{'show_types':1,'where':condition},function(data){
		$('.typeList').html(data);
	});
}