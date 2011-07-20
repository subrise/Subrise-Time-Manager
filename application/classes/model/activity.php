<?php defined('SYSPATH') or die('No direct script access.');

class Model_Activity extends ORM {
	
	protected $_table_name = 'activities';
	
	protected $_belongs_to = array(
		'project' => array(),
	);
	
	protected $_has_many = array(
		'hours' => array(),
		'tags'  => array(
			'model'   => 'tag',
			'through' => 'tags_activities',
		),
	);
	
	/**
	 * Will set the rules up better when the everything works
	 */
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
	
	public function time_spend($user_id = NULL)
	{
		$time_in_seconds = 0;
				
		if ( empty($user_id) )
			$hours = $this->hours->where('end','!=',NULL)->find_all();
		else
			$hours = $this->hours->where('user_id','=',$user_id)->and_where('end','!=',NULL)->find_all();
			
		foreach ($hours as $hour)
		{
			$time_in_seconds += $hour->end - $hour->start;
		}
		
		return Date::timetoobj($time_in_seconds);
	}

} // End Model_Activity