<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Loader {
	
	public function action_index()
	{
		$user = Auth::instance()->get_user();

		$activities = array();

		$hours = $user->hours
			->order_by('start','desc')
			->find_all();

		foreach ($hours as $hour)
		{
			$activity = $hour->activity;
			$activities[] = $activity;
		}
		
		$activities = $user->get_activities();

		$this->template->page_title = $user->username;
		$this->template->page_view  = View::factory('pages/user_show')
			->bind('activities', $activities)
			->bind('user', $user);
	}
	
} // End Controller_Account