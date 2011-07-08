/* Author: Sammy Hubner

*/

$(document).ready(function(){

	$('#messages li p').prepend('<div class="close iconic x-alt"></div>');
	
	$('#messages li .close').click(function(){
		$(this).hide();
		$(this).parent().parent().slideUp();
	});
	
	$('a.delete').click(function(){
		return confirm('This action will cause a permanent delete of the record. Do you want to continue?','blaat');
	});
	
});



























