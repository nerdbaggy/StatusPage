<?php

//UptimeRobot API Key
$apikey = "Your-API-Key";

//Name to display in nav bar and page title
$websitename = "My Uptime Report";

//How often the page should refresh
$pagerefreshtime = "05:00";

//On the status page what percentage is what color
$percentGreen = 99;
$percentYellow = 96;

//curl timeout
$timeout = 5;

//Uptime percentage for following days
$historyDays = array(1, 7, 30, 360);

//Display names for the uptime percentage of the previous days
$historyDaysNames = array("Past 24 Hours", "Past Week", "Past Month", "Past Year");

//checks to exclude from the status page. This info can be found in the UptimeRobot URL for each check
//$excludedchecks = array("776396792", "776396743");
$excludedchecks = array();
?>

