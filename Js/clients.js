$(document).ready(function(){
	showClients();
	showTreatments();
	
	//Deleting the specific Clients
	$(document).on('click','.deleteClient',function(){
		$.post('classes/Client.php',{'delete_client':$(this).attr('data-id')},function(){
			showClients();
		});
	});
	
	//Searching for specific clients
	$('#search_client').on('keyup',function(){ showClients($(this).val());
	});	
	
	//Searching for specific clients
	$('#search_treatment').on('keyup',function(){ showTreatments($(this).val());
	});	
		
	//Updating an existing client 
	$(document).on('click','.updateBtn',function(){
		$.post('classes/Client.php',{'update_client':$(this).attr('data-id'),'firstname':$('.updateFirstname').val(),'lastname':$('.updateLastname').val(),
		'phone':$('.updatePhone').val()},function(data){			
			if(data=='success')//If added a new client successfully
			{
				$('#updateModal').modal('toggle');
				showClients();
				$('.updateErr').hide().html('');
			}
			else//If there was a problem
				$('.updateErr').show().html(data);
		});
	});
	
	//If clicked one of the update buttons
	$(document).on('click','.editClient',function(){
		id=$(this).attr('data-id');
		$.post('classes/Client.php',{'get_by_email':id},function(data){
			$('.updateBtn').attr('data-id',id)
			$('.updateInfo').html(data);
		});
	});
	
	//Showing the treatment history
	$(document).on('click','.showHistory',function(){
		$.post('classes/Client.php',{'show_history':1},function(data){
			location.href="history.html";
		});		
	});	
});


function showTreatments(condition='')
{
	//Showing all treatments' history
	$.post('classes/Client.php',{'show_history':1,'where':condition},function(data){
		$('.getTreatments').html(data);
	});	
}

//Showing all the existing clients
function showClients(condition='')
{
	//Showing all the existing clients
	$.post('classes/Client.php',{'show_clients':1,'where':condition},function(data){
		$('.ClientsList').html(data);
	});
}