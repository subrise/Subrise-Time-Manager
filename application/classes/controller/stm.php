<?php defined('SYSPATH') or die('No direct script access.');

class Controller_STM extends Controller_Loader {
	
	public function action_index()
	{
		$this->template->page_title = 'Time Management';
		$this->template->page_view  = View::factory('pages/stm');
		
		$projects = ORM::factory('project')->get_projects();
		$project_options = array();
		foreach ($projects as $project)
		{
			$project_options[$project->id] = $project->name;
		}
		
		
	}

} // End Controller_STM