<?php
define('PATH_START', '/documentation');
define('PATH_START_LENGTH', strlen(PATH_START));
define('DOCUMENTATION_PATH', '..' . PATH_START);

// Find out what page we want to see
$page = isset($_GET['page'])? $_GET['page'] : '';

if (strpos($page, '/documentation') !== 0) {
  $error_code = 404;
  require 'error.php';
}

$page = substr($page, PATH_START_LENGTH);

if (substr($page, -1) === '/') {
  $page .= "index";
}

$file = DOCUMENTATION_PATH . "$page.md";

if (!file_exists($file)) {
  $error_code = 404;
  require 'error.php';
}

// Cache page
require '../includes/cache_top.php';

// Use parsedown
require_once '../includes/parsedown.php';
$parsedown = get_parsedown();

$content = file_get_contents($file);
$title = ltrim(explode("\n", $content)[0], "# ");

?>
<!doctype html>
<html>
  <head>
    <title><?php echo $title;?></title>
  </head>
  <body>
  <?php
  echo $parsedown->text($content);
  ?>
  </body>
</html>
<?php
// Finish page cache
require '../includes/cache_bottom.php';
?>
