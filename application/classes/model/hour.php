<?php defined('SYSPATH') or die('No direct script access.');

class Model_Hour extends ORM {
	
	protected $_belongs_to = array(
		'activity' => array(),
		'user'     => array(),
	);
	
	/**
	 * TODO: set the rules
	 */

} // End Model_Hour