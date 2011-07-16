<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tag extends ORM {
	
	protected $_has_many = array(
		'activities' => array(
			'model'   => 'activity',
			'through' => 'tags_activities',
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
	
} // End Model_Tag