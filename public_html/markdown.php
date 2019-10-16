<?php
require "../includes/cache_top.php";

// Use parsedown
require_once "../includes/parsedown.php";

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
<?php
require "../includes/cache_bottom.php";
?>
