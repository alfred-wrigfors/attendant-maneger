<?php
$json_file = AM__PLUGIN_DIR.'/data/settings.json';

$json = file_get_contents($json_file);

$json_data = json_decode($json,true);

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php

    if (!isset($_POST['submit'])) {
      echo "<h3>";
      printf($json_data['welcome_title']);
      echo "</h3>";
      echo "<p>";
      printf($json_data['welcome_message']);
      echo "</p>";
    }else {
      echo "<h3>";
      printf($json_data['confirmation_title']);
      echo "</h3>";
      echo "<p>";
      printf($json_data['confirmation_message']);
      echo "</p>";
    }

     ?>

    <br>
    <br>
    <br>

  </body>
</html>
