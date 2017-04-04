<?php
  /* Require connect file that creates a connection between the app and database */
  require('connect.php');

  /* Reset id variable to 0 with global scope */
  $id = 0;

  /* Get all the number of rows and increment the id number by one, this becomes to new preset id */
  if($result = $link->query("SELECT * FROM communityPresets")){
    $id = $result->num_rows+1;
    $result->close();
  }

  /* Set all post variables */
  $name = $_POST['name'];
  $desc = $_POST['desc'];
  $type = $_POST['type'];
  $speed = $_POST['speed'];
  $temp = $_POST['temp'];
  $user_id = 1;


  /* Insert preset info into the communityPreset table and link the preset the users subscribed presets via the myPreset table */
  mysqli_query($link, "INSERT INTO communityPresets (id,name,description,type,speed,temp,user_id) VALUES ('$id', '$name', '$desc', '$type', '$speed', '$temp', '$user_id')");
  mysqli_query($link, "INSERT INTO myPresets (user_id,preset_id) VALUES (1, $id)");

  /* Close the connection */
  $link->close();

  /* Redirect user too the community preset page */
  $url = "http://45.76.83.52/Ark/subPresets.php";
  header('Location: '.$url);
  die();
 ?>
