<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Project extends Controller_Loader {
	
	/**
	 * This action is the welcome page for the project module.
	 */
	public function action_index()
	{
		$view     = View::factory('pages/projects');
		$projects = ORM::factory('project')->get_projects();
		
		$view->bind('projects', $projects);
		
		$this->template->page_title = 'Projects';
		$this->template->page_view  = $view;
	}
	
	/**
	 * This action will create or edit a project. 
	 */
	public function action_edit()
	{
		$project = ORM::factory('project', $this->request->param('id'));
		$post = $this->request->post();
		
		if ($post)
		{
			$project->values($post);
			try
			{
				$project->save();
				
				$this->request->redirect('project/edit/'.$project->id);
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('/models/project');
				$fb = '<ul>';
				foreach ($errors as $error_key => $error)
				{
					$fb .= '<li>'.$error.'</li>';
				}
				$fb .= '</ul>';
				$this->template->error_feedback = $fb;
			}
		}
		
		if ($project->loaded())
		{
			$this->template->page_title = 'Edit ' . $project->name;
		}
		else
		{
			$this->template->page_title = 'Create new project';
		}
		$this->template->page_view = View::factory('pages/project_edit')
			->bind('project', $project);
	}
	
	/**
	 * This action will trash the project, but not delete it.
	 */
	public function action_trash()
	{
		$project = ORM::factory('project', $this->request->param('id'));
		$project->trash();
	}

} // End Controller_Project