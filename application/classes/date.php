<?php defined('SYSPATH') or die('No direct script access.');

class Date extends Kohana_Date {
	
	public static function timetostr($time_in_seconds = 0)
	{
		$time_spend = Date::timetoobj($time_in_seconds);
		if ($time_in_seconds < Date::MINUTE)
		{
			// if not longer than a minute
			return $time_spend->seconds.' seconds.';
		}
		else if ($time_in_seconds < Date::HOUR)
		{
			// if not longer than an hour
			return $time_spend->minutes.' minutes and '.$time_spend->seconds.' seconds.';
		}
		else
		{
			// if longer than an hour
			return $time_spend->hours.' hours, '.$time_spend->minutes.' minutes and '.$time_spend->seconds.' seconds.';
		}
	}
	
	public static function timetoobj($time_in_seconds = 0)
	{
		$hours = $minutes = $seconds = 0;
		
		if ($time_in_seconds < Date::MINUTE)
		{
			// if not longer than a minute
			$seconds = $time_in_seconds;
		}
		else if ($time_in_seconds < Date::HOUR)
		{
			// if not longer than an hour
			$minutes = floor($time_in_seconds/Date::MINUTE);
			$seconds = $time_in_seconds - ($minutes * Date::MINUTE);
		}
		else
		{
			// if longer than an hour
			$hours   = floor($time_in_seconds/(Date::HOUR));
			$seconds = $time_in_seconds - ($hours * Date::HOUR);
			$minutes = floor($seconds/Date::MINUTE);
			$seconds = $seconds - ($minutes * Date::MINUTE);
		}
		
		$ret = new stdClass();
		$ret->hours = $hours;
		$ret->minutes = $minutes;
		$ret->seconds = $seconds;
		return $ret;
	}
	
} // End Time