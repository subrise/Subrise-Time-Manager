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

} // End Model_Activity