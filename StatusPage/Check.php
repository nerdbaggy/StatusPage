<?php

namespace NerdBaggy;

class Check
{

	private $name = null;
	private $checkID = null;
	private $apiKey = null;
	private $status = null;
	private $allUptime = null;
	private $uptimeRatios = null;
	private $tz = null;
	private $logs = null;
	private $responseTime = null;
	private $id = null;

	public function setID($id)
	{
		$this->id = $id;
	}

	public function setStaus($status)
	{
		$this->status = $status;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setAllUptime($allUptime)
	{
		$this->allUptime = $allUptime;
	}

	public function setUptimeRatios($uptimeRatios)
	{
		$this->uptimeRatios = $uptimeRatios;
	}

	public function setTZ($tz)
	{
		$this->tz = $tz;
	}

	public function setLogs($logs)
	{
		$this->logs = $logs;
	}

	public function setResponseTime($responseTime)
	{
		$this->responseTime = $responseTime;
	}

	public function getID()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getAllUptime()
	{
		return $this->allUptime;
	}

	public function getUptimeRatios()
	{
		return $this->uptimeRatios;
	}

	public function getTZ()
	{
		return $this->tz;
	}

	public function getLogs()
	{
		return $this->logs;
	}

	public function getResponseTime()
	{
		return $this->responseTime;
	}
}
?>