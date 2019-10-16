<?php

// Use parsedown
require_once "parsedown.php";

$parsedown = get_parsedown();

?>
<!doctype html>
<html>
  <head>
  </head>
  <body>
  <?php
  echo $parsedown->text('Hello _Parsedown_!');
  ?>
  <pre>
  <?php
  var_dump($_GET);
  ?>
  </pre>
  </body>
</html>
