<?php
  /* Require connect file that creates a connection between the app and database */
  require('connect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ark Community Presets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
      <div class="grid-10-sm grid-offset-1-sm sub-title">
        <h4> COMMUNITY PRESETS</h4>
      </div>
      <div class="grid-10-sm grid-offset-1-sm input-container">
        <input type="text" placeholder="Search by username or plastic" />
      </div>

      <!-- Container for presets -->
      <div class="presetContainer grid-12-sm">
        <?php

          /* Database query to get all presets that have not been made by ARK */
          $defaultPresets = mysqli_query($link, "SELECT * FROM communityPresets WHERE user_id != 0 ORDER BY id desc");

            /* Loop through results if results are returned */
            if($defaultPresets->num_rows > 0){
              while($row = $defaultPresets->fetch_assoc()){
                ?>
                <div class='preset grid-10-sm grid-offset-1-sm'>
                  <img src='img/ph.jpg' />
                  <?php

                    /* Check if presets have been made by the user and remove the add button if true */
                    if($row['user_id'] != 0 || $row['user_id'] != 1){
                  ?>
                  <div <?php echo "id='".$row['id']."'"; ?> class="preset-add">
                    <i class='ion-ios-plus'></i>
                    <p>ADD</p>
                  </div>
                  <?php
                    }
                  ?>

                  <!-- Build up the preset html and input preset information from the database -->
                  <h4><?php echo $row['name']; ?></h4>
                  <p><?php echo $row['description']; ?></p>
                  <div class='preset-inner'>
                    <div class='preset-setting'>
                      <h5>SPEED</h5>
                      <p><?php echo $row['speed']; ?> RPM</p>
                    </div>
                    <div class='preset-setting'>
                      <h5> TEMPERATURE </h5>
                      <p><?php echo $row['temp']; ?> DEGREES</p>
                    </div>
                    <div class='preset-setting'>
                      <h5> TYPE </h5>
                      <p><?php echo $row['type']; ?></p>
                    </div>
                  </div>
                </div>
                <?php
              }
            }else{
              /* If there are no presets in the community print message */
              echo "<p>Sorry there doesn't seem to be any presets here.</p>";
            }
        ?>
      </div>
      <!-- Hidden form to send the id of the preset that the user wants to add to there own preset collection -->
      <form action="addPreset.php" method="POST">
        <input type="hidden" name="id" class="add-preset-form"></input>
        <button type=submit class="add-preset-form-submit submit"></button>
      </form>
    </section>
    <script src="js/nav.js"></script>
    <script src="js/presets.js"></script>
  </body>
</html>
