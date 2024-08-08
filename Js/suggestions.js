showSuggestions();

//Searching for specific suggestions
$('#search_suggestions').on('keyup',function(){ showSuggestions($(this).val());
});

//Function that shows existing suggestions
function showSuggestions(condition='')
{
	$.post('classes/Suggestions.php',{'show_suggestion':1,'where':condition},function(data){
		$('.show_suggestions').html(data);	
	});
}