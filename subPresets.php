<?php
  /* Require connect file that creates a connection between the app and database */
  require('connect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ark My Presets</title>
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

      <!-- List of subscribed presets -->
      <div class="grid-10-sm grid-offset-1-sm sub-title">
        <h4> SUBSCRIBED PRESETS</h4>
      </div>
      <div class="grid-10-sm grid-offset-1-sm input-container">
        <input type="text" placeholder="Search by username or plastic" />
      </div>
      <div class="presetContainer grid-12-sm">
        <?php

          /* Get presets that have been create by ARK */
          $defaultPresets = mysqli_query($link, "SELECT * FROM communityPresets WHERE user_id = 0");
            if($defaultPresets->num_rows > 0){
              while($row = $defaultPresets->fetch_assoc()){
                ?>
                <!-- Build html structure with preset variables -->
                <div class='preset grid-10-sm grid-offset-1-sm'>
                  <img src='img/ph.jpg' />
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
              /* Print message if no results are returned */
              echo "Sorry there seems to be a problem getting your presets";
            }

            /* Get all preset ids that the user has subscribed to */
            $subbedPresets = mysqli_query($link, "SELECT * FROM myPresets WHERE user_id = 1");
              if($subbedPresets->num_rows > 0){
                while($row = $subbedPresets->fetch_assoc()){
                  $id = $row['preset_id'];

                  /* Get all the preset information from the preset ids that matched the users id */
                  $matchedPresets = mysqli_query($link, "SELECT * FROM communityPresets WHERE id = $id");
                    while($row = $matchedPresets->fetch_assoc()){
                  ?>

                  <!-- Build html structure with preset variables -->
                  <div class='preset grid-10-sm grid-offset-1-sm'>
                    <img src='img/ph.jpg' />
                    <div <?php echo "id='".$row['id']."'"; ?> class="preset-remove">
                      <i class='ion-ios-close'></i>
                      <p>REMOVE</p>
                    </div>
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
                }
              }else{
                /* Prompt user to add there own presets if there are no presets that they have subscribed to */
                echo "<a href='/Ark/newPreset.html'><div class='btn grid-8-sm grid-offset-2-sm'><div class='grid-1-sm grid-offset-2-sm'><i class='ion-ios-plus'></i></div><div class='grid-8-sm'><p>ADD YOUR OWN</p></div></div></a>";
              }
        ?>
      </div>
      <!-- Hidden form to remove presets from the users subscribed preset list -->
      <form action="removePreset.php" method="POST">
        <input type="hidden" name="id" class="remove-preset-form"></input>
        <button type=submit class="remove-preset-form-submit submit"></button>
      </form>
    </section>
    <script src="js/nav.js"></script>
    <script src="js/presets.js"></script>
  </body>
</html>
