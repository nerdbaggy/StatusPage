<?php
//Uptime Robot API Key
$apiKey = 'Your-API-KEY';

//Text to display on Nav Bar and page title
$websitename = 'Status Page';

//How often the page should refresh the checks
$pagerefreshtime = '05:00';

//Uptime percentage for following days
$historyDay = array(1, 7, 30, 360);

//Display names for the uptime percentage of the previous days
$historyDaysNames = array('Past 24 Hours', 'Past Week', 'Past Month', 'Past Year');

//On the status page what percentage is what color
$percentGreen = 99;
$percentYellow = 96;

//Display an alert at the top of the page alerting the user
$alertEnabled = False;
//What type of message could be displayed (sucess, warning, info, alert, secondary, standard)
//You can see what each color looks like here: http://foundation.zurb.com/docs/components/alert_boxes.html
$alertType = 'warning';

//What the alert box should say
$alertMessage = 'We are working on the downtime';

//checks to exclude from the status page. This info can be found in the UptimeRobot URL for each check
//$excludedchecks = array("776396792", "776396743");
$excludedChecks = array();

//Show a link to your twitter in the nav bar
$showTwitter = False;
$twitterURL = 'https://twitter.com/nerdbaggy';
$twitterTitle = 'Status Twitter';
?>
