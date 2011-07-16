<?php defined('SYSPATH') or die('No direct script access.');

class Model_Project extends ORM {
	
	protected $_has_many = array(
		'activities' => array(
			'model' => 'activity',
		),
	);

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 3)),
				array('max_length', array(':value', 255)),
			),
		);
	}
	
	/**
	 * Returns all the none trashed projects.
	 */
	public function get_projects()
	{
		return $this
			->where('trashed', '!=', 1)
			->order_by('name')
			->find_all();
	}
	
	public function get_trash()
	{
		$orm = $this
			->where('trashed', '=', 1)
			->order_by('name')
			->find_all();
			
		$ret = array();
		foreach ($orm as $result)
		{
			$project              = new stdClass();
			$project->id          = $result->id;
			$project->name        = $result->name;
			$project->restore_url = URL::site('project/restore/'.$project->id);
			$project->delete_url  = URL::site('project/delete/'.$project->id);
			$ret[]                = $project;
		}
		
		return $ret;
	}
	
	public function trash()
	{
		if ($this->loaded())
		{
			$this->trashed = 1;
			return $this->save();
		}
		else
			return FALSE;
	}
	
	public function restore()
	{
		if ($this->loaded())
		{
			$this->trashed = 0;
			return $this->save();
		}
		else
			return FALSE;
	}

} // End Model_Project