<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Project extends Controller_Loader {
	
	public function action_index()
	{
		$view = View::factory('pages/projects');
		
		$projects = ORM::factory('project')
			->order_by('name')
			->find_all();
		
		$view->bind('projects', $projects);
		
		
		$this->template->page_title = 'Projects';
		$this->template->page_view  = $view;
	}
	
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

} // End Controller_Project