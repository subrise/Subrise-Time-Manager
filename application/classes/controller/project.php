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
				$errors = $e->errors('models');
				foreach ($errors as $error_key => $error)
				{
					Msg::instance()->set( Msg::ERROR, $error);
				}
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
		Msg::instance()->set( Msg::NOTICE, "You've just send a project to the trash bin. You can still restore it.");
		$this->request->redirect('project');
	}
	
	/**
	 * This action will show all items in the trashbin
	 */
	public function action_trashbin()
	{
		$trash = ORM::factory('project')->get_trash();
		$this->template->page_title   = 'Projects Trash Bin';
		$this->template->page_view    = View::factory('pages/trashbin')
			->bind('trash', $trash)
			->set('trash_type', 'Project name');
	}
	
	public function action_restore()
	{
		ORM::factory('project', $this->request->param('id'))->restore();
		$this->request->redirect('project/trashbin');
	}
	
	public function action_delete()
	{
		ORM::factory('project', $this->request->param('id'))->delete();
		$this->request->redirect('project/trashbin');
	}

} // End Controller_Project