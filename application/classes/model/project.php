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
	
	public function time_spend($user_id = null)
	{
		$activities = $this->activities->find_all();
		$time_in_seconds = 0;
		
		foreach ($activities as $activity)
		{
			if ( empty($user_id) )
				$hours = $activity->hours->where('end','!=',NULL)->find_all();
			else
				$hours = $activity->hours->where('user_id','=',$user_id)->and_where('end','!=',NULL)->find_all();
			
			foreach ($hours as $hour)
			{
				$time_in_seconds += $hour->end - $hour->start;
			}
		}
		
		return Date::timetoobj($time_in_seconds);
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