<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Activity extends Controller_Loader {
	
	public function action_add()
	{
		$post = $this->request->post();
		$activity = ORM::factory('activity');
		
		if ($post)
		{
			$activity->values($post);
			
			try
			{
				$activity->save();
				Msg::instance()->set( Msg::SUCCESS, 'Activity successful added to the project.');
				$this->request->redirect('activity/show/'.$activity->id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
				foreach ($errors as $error_key => $error)
				{
					Msg::instance()->set( Msg::ERROR, $error);
				}
			}
		}
		
		$projects = ORM::factory('project')->get_projects();
		$project_options = array();
		foreach ($projects as $project) 
		{
			$project_options[$project->id] = $project->name;
		}
		
		$this->template->page_title = 'Add new activity';
		$project_id = $this->request->param('id');
		$this->template->page_view = View::factory('pages/activity_add')
			->bind('project_id', $project_id)
			->bind('project_options', $project_options)
			->bind('activity', $activity);
	}
	
	public function action_edit()
	{
		$activity = ORM::factory('activity', $this->request->param('id'));
		
		$post = $this->request->post();
		if ($post)
		{
			$activity->values($post);
			try
			{
				$activity->save();
				Msg::instance()->set( Msg::SUCCESS, 'Activity successful updated.');
				$this->request->redirect('activity/show/'.$activity->id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('models');
				foreach ($errors as $error_key => $error)
				{
					Msg::instance()->set( Msg::ERROR, $error);
				}
			}
		}
		
		$projects = ORM::factory('project')->get_projects();
		$project_options = array();
		foreach ($projects as $project) 
		{
			$project_options[$project->id] = $project->name;
		}
		
		$this->template->page_title = 'Update activity';
		$project_id = $activity->project_id;
		$this->template->page_view = View::factory('pages/activity_add')
			->bind('project_id', $project_id)
			->bind('project_options', $project_options)
			->bind('activity', $activity);
	}
	
	
	/**
	 * The binds given to the view
	 * ORM       : activity
	 * datetime  : worked_seconds
	 * ORM       : open_hour
	 */
	public function action_show()
	{
		$activity = ORM::factory('activity', $this->request->param('id'));

		// calculate the amount of seconds you already worked on the activity
		$worked_hours = $activity->hours
			->where('user_id','=',Auth::instance()->get_user()->id)
			->and_where('end','!=', NULL)
			->find_all();
		
		$worked_seconds = 0;
		
		foreach ($worked_hours as $hour) 
		{
			$worked_seconds += $hour->end - $hour->start;
		}
		
		
		// check if the user has an open hour: currently working on the activity
		$open_hour = $activity->hours
			->where('user_id','=', Auth::instance()->get_user()->id)
			->and_where('end','=',NULL)
			->find();

		if ( ! $open_hour->loaded() )
		{
			$open_hour = ORM::factory('hour');
			$status    = 'closed';
		}
		else
			$status = 'open';
		
		$this->template->page_title = $activity->name;
		$this->template->page_view  = View::factory('pages/activity_show')
			->bind('activity', $activity)
			->bind('worked_seconds', $worked_seconds)
			->bind('open_hour', $open_hour)
			->bind('status', $status);
	}
	
	/**
	 * Function: this action will start clocking the time of an activity.
	 * Param: id -> Id of the activity you want to start the time on.
	 */
	public function action_startclock()
	{
		$activity = ORM::factory('activity', $this->request->param('id'));
		if ($activity->loaded())
		{
			// first check if user already is working
			$hour = Auth::instance()->get_user()->hours
				->and_where('end', '=', NULL)
				->find();
			if ( ! $hour->loaded() )
			{
				$hour = ORM::factory('hour');
				$hour->activity_id = $activity->id;
				$hour->user_id     = Auth::instance()->get_user()->id;
				$hour->start       = time();
				$hour->save();
				Msg::instance()->set(Msg::SUCCESS, 'You started working on ' . $activity->name .'. Get busy.');
				$this->request->redirect('activity/show/'.$activity->id);
			}
			else
			{
				Msg::instance()->set(Msg::ERROR, 'You are already working on ' . $hour->activity->name .' and cannot start a new activity.');
				$this->request->redirect('activity/show/'.$activity->id);
			}
		}
		else
		{
			Msg::instance()->set(Msg::ERROR, 'The activity you are trying to work on, does not exist.');
			$this->request->redirect('project');
		}
	}
	
	/**
	 * Function: this action will stop the time on an activity. 
	 * Param: id -> Id of the activity you want to stop the time on.
	 */
	public function action_stopclock()
	{
		$activity = ORM::factory('activity', $this->request->param('id'));
		if ($activity->loaded())
		{
			// first check if an hour is already open
			$hour = $activity->hours
				->where('user_id','=', Auth::instance()->get_user()->id)
				->and_where('end', '=', NULL)->find();
			if ( $hour->loaded() )
			{
				$hour->end = time();
				$hour->save();
				Msg::instance()->set(Msg::SUCCESS, 'You stopped the time on ' . $activity->name .'. Take your well deserved break.');
				
				$this->request->redirect('activity/show/'.$activity->id);
			}
			else
			{
				Msg::instance()->set(Msg::ERROR, 'You haven\t even started working on ' . $activity->name .'. Jack ass!');
				$this->request->redirect('activity/show/'.$activity->id);
			}
		}
		else
		{
			Msg::instance()->set(Msg::ERROR, 'The activity you are trying to stop the clock on, does not exist.');
			$this->request->redirect('project');
		}
	}
	
} // End Controller_Activity
