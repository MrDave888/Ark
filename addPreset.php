<?php
  /* Require connect file that creates a connection between the app and database */
  require('connect.php');

  /* Set id variable to the post id variable */
  $id = $_POST['id'];

  /* Insert the new preset into the myPresets table */
  mysqli_query($link, "INSERT INTO myPresets (user_id,preset_id) VALUES (1, $id)");

  /* Redirect the user to the subscribed presets page */
  $url = "http://45.76.83.52/Ark/subPresets.php";
  header("Location: ".$url);
  die();
?>
