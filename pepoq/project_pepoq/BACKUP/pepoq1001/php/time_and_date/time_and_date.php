<?php

class TimeAndDate
{
	//2015-12-12 
	//12:34:56
	public function getPostTimeDate($created_date)
	{
		$created_date = explode(' ', $created_date);
		// ex: 12/12
		$month_day = explode('-', $created_date[0]);
		$month_day = $month_day[1].'/'.$month_day[2];

		// ex: 12:34
		$created_time = explode(':', $created_date[1]);
		$created_time = $created_time[0].':'.$created_time[1];

		// ex: 12/12 12:34
		$time_and_date = $month_day.' '.$created_time;
		return $time_and_date;
	}

}