	showCompanies();
	
	//Adding a new company's information
	$(document).on('click','.addBtn',function(){
		$.post('classes/Companies.php',{'manage_company':0,'company_name':$('.addCompanyName').val(),
		'phone':$('.addPhone').val(),'email':$('.addEmail').val()},function(data){
			if(data=='success')//If added a new company successfully
			{
				$('#addModal').modal('toggle');
				showCompanies();
				$('.addErr').hide().html('');
			}
			else//If there was a problem
				$('.addErr').show().html(data);
		});
	});
	
	//Searching for specific companies
	$('#search_company').on('keyup',function(){ showCompanies($(this).val());
	});
	
	//Updating an existing company 
	$(document).on('click','.updateBtn',function(){
		$.post('classes/Companies.php',{'manage_company':$(this).attr('data-id'),'company_name':$('.updateCompanyName').val(),
		'phone':$('.updatePhone').val(),'email':$('.updateEmail').val()},function(data){
			if(data=='success')//If added a new company successfully
			{
				$('#updateModal').modal('toggle');
				showCompanies();
				$('.updateErr').hide().html('');
			}
			else//If there was a problem
				$('.updateErr').show().html(data);
		});
	});
	
	//Deleting the specific company
	$(document).on('click','.deleteCompany',function(){
		$.post('classes/Companies.php',{'delete_company':$(this).attr('data-id')},function(){
			showCompanies();
		});
	});

	//If clicked one of the update buttons
	$(document).on('click','.editCompany',function(){
		id=$(this).attr('data-id');
		$.post('classes/Companies.php',{'get_by_id':id},function(data){
			$('.updateBtn').attr('data-id',id)
			$('.updateInfo').html(data);
		});
	});	
	
	//Function that shows all the existing companies
	function showCompanies(condition='')
	{
		$.post('classes/Companies.php',{'show_companies':1,'where':condition},function(data){
			$('.CompaniesList').html(data);
		});
	}
