<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Template controller that sets and loads default properties
 */
class Controller_Loader extends Controller_Template {
	
	public $template = 'loader';
	
	public function before()
	{
		parent::before();
		
		// needs to be logged in 
		if ( ! Auth::instance()->logged_in() AND $this->request->action() !== 'login')
			$this->request->redirect('auth/login');
	}
	
	public function after()
	{
		if (isset($this->template->page_title))
			View::bind_global('page_title', $this->template->page_title);
		
		return parent::after();
	}

} // End Controller_Loader