<?php require('StatusPage/config.php'); ?>

<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="icons/favicon.ico">
		<link rel="apple-touch-icon" sizes="57x57" href="icons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="icons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="60x60" href="icons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="76x76" href="icons/apple-touch-icon-76x76.png">
		<link rel="icon" type="image/png" href="icons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="icons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="icons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-config" content="icons/browserconfig.xml">
		<title><?php echo $websitename; ?></title>
		<link rel="stylesheet" href="includes/css/normalize.css">
		<link rel="stylesheet" href="includes/css/foundation.min.css">
		<link rel="stylesheet" href="includes/css/app.css">
		<link rel="stylesheet" href="includes/css/foundation-icons.css">
		<script src="includes/js/vendor/modernizr.js"></script>
	</head>
	<body>
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="#"><?php echo $websitename; ?></a></h1>
				</li>
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
			<section class="top-bar-section">
				<!-- Page Refresh Time -->
				<ul class="right">
					<li class="name"><h1><a href="#"><i class="fi-refresh"></i>&nbsp;Next Update in <span id="timetill"><?php echo $pagerefreshtime ?></span></a></h1></li>
				</ul>
				<ul class="left">
					<!-- Twitter Nav Bar Link -->
					<?php
					if ($showTwitter)
					{
						echo "<li><a href=$twitterURL><i class=\"fi-social-twitter\"></i> $twitterTitle</a></li>";
					}
					?>
				</ul>
			</section>
		</nav>
		<br>
		<!-- User Defined Alert Bar -->
		<div class="row">
			<?php
			if ($alertEnabled){
				echo "<div data-alert class=\"alert-box $alertType radius\">$alertMessage<a href=\"#\" class=\"close\">&times</a> </div>";
			}
			
			?>
		</div>

		<div class="row">
			<div class="panel radius">
				<div id="reload">
					<?php include 'StatusPage/Ajax.php'; ?>
				</div>
			</div>
		</div>

		<div class="row">
			<p><a href="https://github.com/nerdbaggy/StatusPage"><i class="fi-social-github"></i> Powered By OpenStatusPage <a></p>
		</div>

		<div id="logs" class="reveal-modal small" data-reveal></div>

		<!-- JS -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="includes/js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
		<script>
		//Refresh page JS
			$(document).ready(function (e) {
				var $timer = $("#timetill");
				function update() {
					var myTime = $timer.html();
					var ss = myTime.split(":");
					var dt = new Date();
					dt.setMinutes(ss[0]);
					dt.setSeconds(ss[1]);
					var dt2 = new Date(dt.valueOf() - 1000);
					var temp = dt2.toTimeString().split(" ");
					var ts = temp[0].split(":");
					$timer.html(ts[1]+":"+ts[2]);
					if((ts[1]==="00") &&(ts[2]==="00")){
						$("#reload").load("StatusPage/Ajax.php");
						$timer.html("<?php echo $pagerefreshtime?>");
						setTimeout(update, 1000);
					}
					else{ setTimeout(update, 1000);}
				}
				setTimeout(update, 1000);
			});
		</script>
	</body>
</html>
