<?php
require('Check.php');
require('StatusPage.php');
require('config.php');

$cid =$_GET["cid"];

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {


//Validation
if (!is_numeric($cid) || strlen($cid) > 20){
	die("Invalid Check ID");
}

function timeChange($tsstart, $stend, $timezone = 0)
{
	$tdelta = strtotime($tsstart) - strtotime($stend);
	$hours=(int)(($tdelta / 3600) + $timezone);
	$minutes = date("i", $tdelta);
	return "<td>$hours Hrs, $minutes Mins</td>";
}

$StatusPage = new NerdBaggy\StatusPage($apiKey, $historyDay);
$checks = $StatusPage->getChecks();
if (!$checks){
	echo "<div data-alert class=\"alert-box alert radius\">";
	echo "An error occured, please try again";
	echo "</div>";	
}else{
	echo "<h4>{$checks[$cid]->getName()}</h4>";
	echo "<hr>";
	?>

	<table style="width: 100%;">
		<thead>
			<tr>
				<th>Event</th>
				<th>Date-Time</th>
				<th>Duration</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$logs = $checks[$cid]->getLogs();
				foreach ($logs as $key => $log) {
					echo "<tr>";
					if ($log['type'] == 1){
						echo "<td><div class=\"alert label radius\"><i class=\"fi-arrow-down\"></i> Down</div></td>";
					}elseif ($log['type'] == 2) {
						echo "<td><div class=\"success label radius\"><i class=\"fi-arrow-up\"></i> Up</div></td>";
					}elseif ($log['type'] == 98) {
						echo "<td><div class=\"secondary label radius\"><i class=\"fi-play\"></i> Started</div></td>";
					}elseif ($log['type'] == 99) {
						echo "<td><div class=\"secondary label radius\"><i class=\"fi-pause\"></i> Paused</div></td>";
					}
					echo "<td>$log[datetime]</td>";

					if ($key == 0){
						echo timeChange(date('d-n-Y H:i:s'), $log['datetime'], $checks[$cid]->getTZ());
					}else {
						echo timeChange($logs[$key-1]['datetime'], $log['datetime']);
					}
					echo "</tr>";
				}
			}
		}else{
				die('You can\'t access this page directly silly');
		}
		?>

<a class="close-reveal-modal">&#215;</a>