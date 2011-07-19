<?php defined('SYSPATH') or die('No direct script access.');

class Date extends Kohana_Date {
	
	public static function timetostr($time_in_seconds = 0)
	{
		if ($time_in_seconds < Date::MINUTE)
		{
			// if not longer than a minute
			return $time_in_seconds.' seconds.';
		}
		else if ($time_in_seconds < Date::HOUR)
		{
			// if not longer than an hour
			$minutes = floor($time_in_seconds/Date::MINUTE);
			$seconds = $time_in_seconds - ($minutes * Date::MINUTE);
			return $minutes.' minutes and '.$seconds.' seconds.';
		}
		else
		{
			// if longer than an hour
			$hours   = floor($time_in_seconds/(Date::HOUR));
			$seconds = $time_in_seconds - ($hours * Date::HOUR);
			$minutes = floor($seconds/Date::MINUTE);
			$seconds = $seconds - ($minutes * Date::MINUTE);
			return $hours.' hours, '.$minutes.' minutes and '.$seconds.' seconds.';
		}
	}
	
} // End Time