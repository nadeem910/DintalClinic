$(document).ready(function(){
	//Updating user
	$(document).on('click','.updateuser',function(){
		$.post('classes/User.php',{'username':$('.username').val(),'password':$('.password').val(),'newpassword':$('.newpassword').val()},function(data){
					
			if(data=='success')
			{
				$('.addSuc').show().html(data);
				$('.usernamed').show().html($('.username').val());	
				$('.addErr').hide();	
			}
			else
			{
				$('.addErr').show().html(data);							
			}
		});
	});
});