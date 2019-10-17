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

// Set real file base
$_cache_real_file = $file;

// Start caching late because we might 404 (and don't want to cache that)
require '../includes/cache_top.php';

// Use parsedown
require_once '../includes/parsedown.php';
$parsedown = get_parsedown();

$content = file_get_contents($file);
$title = strip_tags($parsedown->line(ltrim(explode("\n", $content)[0], "# ")));

// Load html_helper
require_once '../includes/html_helper.php';

html_head($title, 'markdown');
?>
  </head>
  <body class="markdown">
    <div class="markdown-wrapper">
<?php
echo $parsedown->text($content);
?>
    </div>
<?php
html_end(/* "https://github.com/AuraDevelopmentTeam/Documentations" */);

// Finish page cache
require '../includes/cache_bottom.php';
?>
