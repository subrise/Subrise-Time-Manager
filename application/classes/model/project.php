<?php defined('SYSPATH') or die('No direct script access.');

class Model_Project extends ORM {

	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 3)),
				array('max_length', array(':value', 100)),
			),
		);
	}

} // End Model_Project