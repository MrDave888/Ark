<?php
  /* Open new connection to database */
  $link = new mysqli("127.0.0.1", "root", "DJ1357r8", "ark");

  /* If connection fails print errors */
  if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
  }
?>
