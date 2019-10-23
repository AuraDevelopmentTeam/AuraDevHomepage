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

    <!-- Prism (code highlighting) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/line-numbers/prism-line-numbers.css" integrity="sha256-udLi8HM3vM4cuDDMGyRFzG8ek0UN0+uytPLWkbTpagg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/themes/prism-twilight.css" integrity="sha256-wBt31S0ig4cVcJ57bb4O+s6sAD9WXVfyVylVb1gGWNs=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/prism.min.js" integrity="sha384-ccmyu9Bl8HZLIVEUqF+ZzcZTBPB8VgMI2lQpOsNDOvro/1SfRnz3qkub0eUxof1s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/autoloader/prism-autoloader.min.js" integrity="sha384-xF5Qt8AUh+k8ZzozF9d1iDRKeeP1m9PPJKKhy3R/O4+5JccihNLvy1fIuGnkye7+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/line-numbers/prism-line-numbers.min.js" integrity="sha384-g0u6zLvZF3g2I+/vETu7YYk74PXoDBNGy5qtL04/uW6PJGMDeax43A5hFa55xaAT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.17.1/plugins/show-language/prism-show-language.min.js" integrity="sha384-xnJRKz3VKJloaoR0FNJVmbJ55eTSeuztu0Okhd9vvz2hblDQc0UJWVkj3sIikslo" crossorigin="anonymous"></script>
    <!-- KaTeX (math rendering) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css" integrity="sha384-zB1R0rpPzHqg7Kpt0Aljp8JPLqbXI3bhnPWROx27a9N0Ll6ZP/+DiW/UqRcLbRjq" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js" integrity="sha384-y23I5Q6l+B6vatafAwxRu/0oK/79VlbSz7Q9aiSZUvyWYIYsd+qj+o24G5ZU2zJz" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/contrib/auto-render.min.js" integrity="sha384-kWPLUVMOks5AQFrykwIup5lo0m3iMkkHrD0uJ4H5cjeGihAutqP0yW0J6dpFiVkI" crossorigin="anonymous" onload="renderMathInElement(document.body);"></script>
    <!-- Mermaid (graphs) -->
    <script defer src="https://unpkg.com/mermaid@8.4.0/dist/mermaid.min.js" integrity="sha384-VMxod3UViCDOhgl3zLOlLoDd6tt4n3HYqCH9w798Q7U4sY2ueIN9Rz14B9MDfzdt" crossorigin="anonymous" onload="mermaid.initialize({startOnLoad:true});"></script>
  </head>
  <body class="markdown line-numbers">
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
