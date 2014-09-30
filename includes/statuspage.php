<?php
include '../config.php';

function curlCall ($monitor)
{
	global $apikey, $timeout, $historyDays, $excludedchecks;
	
	$historyday = implode("-", $historyDays);

	if (is_null($monitor)){
		$url = "https://api.uptimerobot.com/getMonitors?apikey=$apikey&format=json&logs=1&customUptimeRatio=$historyday&noJsonCallback=1";
	}
	else{
		$url = "https://api.uptimerobot.com/getMonitors?apikey=$apikey&format=json&logs=1&noJsonCallback=1&monitors=$monitor&showTimezone=1";
	}


	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'UptimeRobot Public Status Page',
	    CURLOPT_CONNECTTIMEOUT => $timeout
	));

	$checks = json_decode(curl_exec($curl),TRUE);
	curl_close($curl);

	//Checks to make sure curl is happy
	if(curl_errno($curl)){
		return False;
	}

	//Checks to make sure UptimeRobot didn't return any errors
	if ($checks[stat] != 'ok'){
		return False;
	}

	return $checks;

}

function timeChange($tsstart, $stend, $timezone = 0) {
			$tdelta = strtotime($tsstart) - strtotime($stend);
			$hours=(int)(($tdelta / 3600) + $timezone);
			$minutes = date("i", $tdelta);
			return "<td>$hours Hrs, $minutes Mins</td>";
		}