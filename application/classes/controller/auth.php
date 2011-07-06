<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller {
	
	public function before()
	{
		parent::before();
		
		// needs to be logged in 
		if ( ! Auth::instance()->logged_in() AND $this->request->action() !== 'login')
			$this->request->redirect('auth/login');
	}
	
	public function action_login()
	{
		// if user is already logged in, send him to the welcome page
		if (Auth::instance()->logged_in())
			$this->request->redirect('welcome');
			
		$post = $this->request->post();
		
		if (isset($post['username'], $post['password']))
		{
			// check for valid login
			// TODO: I think the login function escapes the values by itself
			$username = $post['username'];
			$password = $post['password'];
			
			if (Auth::instance()->login($username, $password))
			{
				// user logged in succesfully
				$this->request->redirect('welcome');
			}
			else
			{
				// failed login
				$view = View::factory('login')
					->set('page_title', 'Login failed')
					->set('error_feedback', 'Username and password combination did not match.');
				$this->response->body($view);
			}
		}
		else
		{
			// show clean login form
			$view = View::factory('login')
				->set('page_title', 'Login');
			$this->response->body($view);
		}
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('auth/login');
	}

} // End Controller_Auth