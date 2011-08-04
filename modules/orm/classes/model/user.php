<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

	protected $_has_many = array(
		'user_tokens' => array('model' => 'user_token'),
		'roles'       => array('model' => 'role', 'through' => 'roles_users'),
		'hours'       => array(),
	);
	
	public function get_activities()
	{
		$activities = array();
		
		$activity_ids = $this->hours->select('activity_id')->distinct(TRUE)->find_all();
		$hours = DB::select('activity_id')
			->distinct(TRUE)
			->from('hours')
			->where('user_id','=',$this->id)
			->order_by('start', 'desc')
			->as_object()
			->execute();
		
		foreach ($hours as $hour)
		{
			$activities[] = ORM::factory('activity', $hour->activity_id);
		}
		
		return $activities;
	}

} // End User Model