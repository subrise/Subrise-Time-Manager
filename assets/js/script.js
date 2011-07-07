/* Author: Sammy Hubner

*/

$(document).ready(function(){

	$('.errorFeedback .wrapper').prepend('<div class="close"></div>');
	
	$('.errorFeedback .close').click(function(){
		$(this).hide();
		$('.errorFeedback').slideUp();
	});
	
});



























