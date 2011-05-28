<?php 
	echo View::factory('particles/masthead'); 
	
	if (isset($page_view))
		echo $page_view;
	else
		echo View::factory('pages/404');
	
	echo View::factory('particles/footer');