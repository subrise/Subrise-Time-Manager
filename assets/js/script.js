/* Author: Sammy Hubner

*/

$(document).ready(function(){

	$('#messages li p').prepend('<div class="close iconic x-alt"></div>');
	
	$('#messages li .close').click(function(){
		$(this).hide();
		$(this).parent().parent().slideUp();
	});
	
	$('a.delete').click(function(){
		$(this).hide();
		
		url = $(this).attr('href');
		
		$(this).parent().append('<span>Are you sure?<br /> <a href="'+url+'">Yes</a> <a class="close_delete" href="#">No</a></span>');
		
		$('a.close_delete').click(function(){
			$(this).parent().siblings('.delete').show();
			$(this).parent().remove();
			return false;
		});
		
		return false;
	});
	
	
	
});



























