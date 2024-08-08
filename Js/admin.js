$(document).ready(function(){
	//Admin login
	$(document).on('click','.loginAdmin',function(){
		$.post('classes/Authenticate.php',{'authenticate':1,'admin_username':$('#admin_username').val(),'admin_password':$('#admin_password').val()},function(data){
			if(data=='success')
			{
				location.href="panel.php";
				$('.errAdmin').html('').hide();						
			}
			else
			{
				$('.errAdmin').show().html(data);							
			}
		});
	});
});