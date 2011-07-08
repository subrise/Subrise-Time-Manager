/* Author: Sammy Hubner

*/

$(document).ready(function(){

	$('#messages li p').prepend('<div class="close iconic x-alt"></div>');
	
	$('#messages li .close').click(function(){
		$(this).hide();
		$(this).parent().parent().slideUp();
	});
	
});



























