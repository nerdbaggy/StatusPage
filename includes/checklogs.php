<?php
include '../config.php';
include 'statuspage.php';
$cid =$_GET["cid"];

//Validation
if (!is_numeric($cid) || strlen($cid) > 20){
	die("Invalid Check ID");
}

$checks = curlCall($cid);

if ($checks == False){
	die ("An error occured, please try again");
}
$cname = $checks[monitors][monitor][0][friendlyname];
echo "<h4>Logs for $cname</h4>";
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
		$logs = $checks[monitors][monitor][0][log];
		foreach ($logs as $key => $log) {
			echo "<tr>";
			if ($log[type] == 1){
				echo "<td><div class=\"alert label radius\"><i class=\"fi-arrow-down\"></i> Down</div></td>";
			}elseif ($log[type] == 2) {
				echo "<td><div class=\"success label radius\"><i class=\"fi-arrow-up\"></i> Up</div></td>";
			}elseif ($log[type] == 98) {
				echo "<td><div class=\"secondary label radius\"><i class=\"fi-play\"></i> Started</div></td>";
			}elseif ($log[type] == 99) {
				echo "<td><div class=\"secondary label radius\"><i class=\"fi-pause\"></i> Paused</div></td>";
			}
			
			echo "<td>$log[datetime]</td>";
			if ($key == 0){
				echo timeChange(date('d-n-Y H:i:s'), $log[datetime], $checks['timezone']/60);

			}else {

				echo timeChange($logs[$key-1][datetime], $log[datetime]);
			}
			echo "</tr>";
			


		}
		

		?>

	</tbody>

</table>