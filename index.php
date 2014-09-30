<?php
include 'config.php';
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <!-- If you delete this meta tag World War Z will become a reality -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $websitename; ?></title>

  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/app.css">
  <!-- If you are using the gem version, you need this only -->
  <link rel="stylesheet" href="css/foundation-icons.css">

  <script src="js/vendor/modernizr.js"></script>
</head>
<body>
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="#"><?php echo $websitename; ?></a></h1>
      </li>
      <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>
    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
        <li class="name"><h1><a href="#"><i class="fi-refresh"></i>&nbsp;Next Update in <span id="timetill"><?php echo $pagerefreshtime ?></span></a></h1></li>
      </ul>
    </section>
  </nav>
  <br>
  <br>
  <div class="row">
    <div class="panel radius"> 
      <div id="reload">
        <?php include 'includes/checks.php'; ?>
      </div>
    </div>
  </div>

  <div class="row">
  <span data-tooltip aria-haspopup="true" class="has-tip" title="Powered by PublicStatusPage">
  <a href="https://github.com/nerdbaggy/StatusPage"><i class="fi-social-github"></i></a>
</span>
  </div>

  <div id="myModal" class="reveal-modal small" data-reveal>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
  $(document).foundation();
  </script>

  <script>
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
       $("#reload").load("includes/checks.php");
       $timer.html("<?php echo $pagerefreshtime?>");
       setTimeout(update, 1000);
     }
     else{        setTimeout(update, 1000);}
   }

   setTimeout(update, 1000);
 });
  </script>

</body>
