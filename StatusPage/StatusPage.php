<?php
namespace NerdBaggy;

class StatusPage
{
	private $apiKey = null;
	private $historyDay = null;
	private $allChecks = array();
	
	function __construct($apiKey, $historyDay)
	{
		$this->apiKey = $apiKey;
		$this->historyDay = implode("-", $historyDay);;
	}

	public function getChecks()
	{
		$checks = $this->curlIt();

		foreach ($checks[monitors][monitor] as $key => $check) {
			$newCheck = new Check();
			$newCheck->setID($check[id]);
			$newCheck->setName($check[friendlyname]);
			$newCheck->setStaus($check[status]);
			$newCheck->setUptimeRatios(explode("-", $check[customuptimeratio]));
			$newCheck->setAllUptime($check[alltimeuptimeratio]);
			$newCheck->setLogs($check[log]);
			$newCheck->setTZ($checks[timezone]/60);
			array_push($this->allChecks, $newCheck);
		}

		return $this->allChecks;
	}

	private function curlIt()
	{
		$url = "https://api.uptimerobot.com/getMonitors?apikey=$this->apiKey&format=json&logs=1&customUptimeRatio=$this->historyDay&noJsonCallback=1&showTimezone=1";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'UptimeRobot Public Status Page',
			CURLOPT_CONNECTTIMEOUT => 400
		));
		
		if( ! $result = curl_exec($curl)) 
		{	 
        		trigger_error(curl_error($ch)); 
			return False;
		}	 
		
		curl_close($curl);
		
		$checks = json_decode($result,TRUE);
	

		//Checks to make sure UptimeRobot didn't return any errors
		if ($checks[stat] != 'ok'){
			return False;
		}

		return $checks;
	}


}
