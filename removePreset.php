<?php
  /* Require connect file that creates a connection between the app and database */
  require('connect.php');

  /* Set preset id to variable */
  $id = $_POST['id'];

  /* Delete selected preset from myPresets table */
  mysqli_query($link, "DELETE FROM myPresets WHERE preset_id = $id AND user_id = 1");

  /* Redirect user to the subcribed presets page */
  $url = "http://45.76.83.52/Ark/subPresets.php";
  header("Location: ".$url);
  die();
?>
