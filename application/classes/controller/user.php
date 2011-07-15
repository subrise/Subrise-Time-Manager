<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Loader {
	
	/**
	 * This action is the welcome page for the project module.
	 */
	public function action_index()
	{
		$view   = View::factory('pages/users');
		$users  = ORM::factory('user')->find_all();
		
		$view->bind('users', $users);
		
		$this->template->page_title = 'Users';
		$this->template->page_view  = $view;
	}
	
	/**
	 * This action will edit the users data
	 * Only users with the admin role will be able to edit other users.
	 */
	public function action_edit()
	{
		$user = ORM::factory('user', $this->request->param('id'));
		
		// check if user has enough rights to edit 
		if ( ! Auth::instance()->logged_in('admin') && Auth::instance()->get_user()->id != $user->id )
		{	
			Msg::instance()->set(Msg::ERROR, 'Your account is not allowed to create or edit other user accounts.');
			$this->request->redirect('user');	
		}
		
		
		$view = View::factory('pages/user_edit');
		$view->bind('user', $user);
		
		$post = $this->request->post();
		if ($post)
		{
			try
			{
				$user->username = $post['username'];
				$user->email    = $post['email'];
				if ( ! empty($post['password']) && $post['password'] == $post['password2'] )
					$user->password = $post['password'];
				
				if ($user->loaded())
				{
					$user->save();
					Msg::instance()->set( Msg::SUCCESS, 'Account has succesfully been created.');
				}
				else if ( ! empty($post['password']) && $post['password'] == $post['password2'] )
				{
					$user->save();
					Msg::instance()->set( Msg::SUCCESS, 'Account has been updated.');
				}
				else if (empty($post['password']))
					Msg::instance()->set(Msg::ERROR, 'Cannot create an account with an empty password.');
				else
					Msg::instance()->set(Msg::ERROR, 'The two passwords do not match.');
				
			}
			Catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
				foreach ($errors as $error_key => $error)
				{
					Msg::instance()->set( Msg::ERROR, $error);
				}
			}
		}
		
		if ($user->loaded())
			$this->template->page_title = 'Edit user: ' . $user->username;
		else
			$this->template->page_title = 'Create new user';
			
		$this->template->page_view  = $view;
	}

} // End Controller_User