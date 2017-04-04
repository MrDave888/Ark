<?php
  require('connect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ark New Print</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body>

    <!-- Side nagivation -->
    <div class="side-nav">
      <div class="close">
        <i class="ion-ios-close"></i>
      </div>
      <ul>
        <li>
          <a href="/Ark">
            <p> HOME <p>
          </a>
        </li>
        <li>
          <a href="/Ark/queue.html">
            <p> QUEUE <p>
          </a>
        </li>
        <li>
          <a href="/Ark/community.php">
            <p> COMMUNITY PRESETS <p>
          </a>
        </li>
        <li>
          <a href="/Ark/subPresets.php">
            <p> SUBSCRIBED PRESETS <p>
          </a>
        </li>
      </ul>
    </div>

    <!-- Main container -->
    <section class="container grid-12-sm">

      <!-- Header -->
      <header class="grid-12-sm">
        <nav class="open grid-1-sm grid-offset-1-sm">
          <i class="ion-navicon"></i>
        </nav>
        <div class="logo grid-offset-7-sm grid-2-sm">
          <h4> ARK </h4>
        </div>
      </header>

      <!-- New print setting inputs -->
      <div class="grid-10-sm grid-offset-1-sm sub-title">
        <h4> NEW PRINT</h4>
      </div>
      <div class="new-preset-setting grid-10-sm grid-offset-1">
        <h4> DEVICE </h4>
        <div class="swiper-container">
          <div class="device-swiper swiper-wrapper">

          </div>
        </div>
      </div>
      <div class="new-preset-setting grid-10-sm grid-offset-1">
        <h4> PRESET </h4>
        <div class="swiper-container">
          <div class="preset-swiper swiper-wrapper">
            <?php

              /* Get all the preset ids that are in the users subscribed preset list */
              $presetList = mysqli_query($link, "SELECT * FROM myPresets");
              if($presetList->num_rows > 0){
                while($row = $presetList->fetch_assoc()){
                  $id = $row['preset_id'];

                  /* Get all preset information that matches the preset id aquired in the last query */
                  $matchedPresets = mysqli_query($link, "SELECT * FROM communityPresets WHERE id = $id");
                  while($row = $matchedPresets->fetch_assoc()){
                  ?>
                  
                    <!-- Print name within swiper slide to create options for the preset settings -->
                    <div class="swiper-slide"><?php echo $row['name'];?></div>
                  <?php
                  }
                }
              }
            ?>
          </div>
        </div>
      </div>
      <div class="btn new-print grid-8-sm grid-offset-2-sm">
        <div class="grid-1-sm grid-offset-2-sm">
          <i class="ion-power"></i>
        </div>
        <div class="grid-8-sm">
          <p>START PRINT</p>
        </div>
      </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/newPrint.js"></script>
  </body>
</html>
