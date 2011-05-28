<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Loader {
	
	public function action_index()
	{
		$this->template->page_title = 'Time Management';
		$this->template->page_view  = View::factory('pages/welcome');
	}
	
	public function action_login()
	{
		// if user is already logged in, send him to the welcome page
		if (Auth::instance()->logged_in())
			$this->request->redirect('welcome');
		
		if (isset($_POST['username'], $_POST['password']))
		{
			// check for valid login
			// TODO: I think the login function escapes the values by itself
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			if (Auth::instance()->login($username, $password))
			{
				// user logged in succesfully
				$this->request->redirect('welcome');
			}
			else
			{
				// failed login
				$this->template->page_title = 'Login failed';
				$this->template->page_view  = View::factory('pages/login')
					->set('error_feedback', 'Username and password combination did not match.');
			}
		}
		else
		{
			// show clean login form
			$this->template->page_title = 'Login';
			$this->template->page_view  = View::factory('pages/login')
				->set('test', 'woot');
		}
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('welcome/login');
	}

} // End Controller_Welcome