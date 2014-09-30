<?php
include '../config.php';
include 'statuspage.php';

$checks = curlCall();

if ($checks == False){
  echo "<div data-alert class=\"alert-box alert radius\">";
  echo "An error occured, please try again";
  echo "</div>";
}else{

?>

<h2>Uptime Report</h2>
<table style="width: 100%;">
  <thead>
    <tr>
      <th>Check Name</th>
      <th class="text-center">Current Status</th>
      <?php
        foreach ($historyDaysNames as $historyDaysName) {
          echo "<th class=\"text-center\">$historyDaysName</th>";
        }

      ?>
      <th class="text-center">Total Check History</th>

    </tr>
</thead>
 <tbody>




<?php

foreach ($checks[monitors][monitor] as $check) {
  $uptimeratios = explode("-", $check[customuptimeratio]);
  //print_r($check);

  if (!in_array($check[id], $excludedchecks))
  {

  echo "<tr>";
    echo "<td><a href=\"includes/checklogs.php?cid=$check[id]\" data-reveal-id=\"myModal\" data-reveal-ajax=\"true\"><i class=\"fi-list-thumbnails\"></i></a> $check[friendlyname] </td>";

    if ($check['status'] == 2) {
      echo "<td class=\"green text-center\">Online</td>";
    }elseif ($check['status'] == 1) {
      echo "<td class=\"grey text-center\">Pending</td>";
    }elseif ($check['status'] == 0) {
      echo "<td class=\"grey text-center\">Paused</td>";
    }else{
      echo "<td class=\"red text-center\">Offline</td>";
    }

    foreach ($uptimeratios as $uptimeratio) {
      if ($uptimeratio >= $percentGreen){
        echo "<td class=\"green text-center\">$uptimeratio%</td>";
      }elseif ($uptimeratio >= $percentYellow) {
        echo "<td class=\"yellow text-center\">$uptimeratio%</td>";
      }else{
        echo "<td class=\"red text-center\">$uptimeratio%</td>";
      }
    }

    if ($check[alltimeuptimeratio] >= $percentGreen){
        echo "<td class=\"green text-center\">$check[alltimeuptimeratio]%</td>";
      }elseif ($check[alltimeuptimeratio] >= $percentYellow) {
        echo "<td class=\"yellow text-center\">$check[alltimeuptimeratio]%</td>";
      }else{
        echo "<td class=\"red text-center\">$check[alltimeuptimeratio]%</td>";
      }
    }





  echo "</tr>";
}


?>


 </tbody>
</table>




</div>


<?php
}

?>