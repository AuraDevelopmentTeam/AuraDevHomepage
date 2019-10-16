<?php
// Allow invoker to override the file name and cache time
if (!isset($_cache_file)) $_cache_file = $_SERVER['REQUEST_URI'];
if (!isset($_cache_cachetime)) $_cache_cachetime = 18000; // 5 hours by default

// Unadjustable values
$_cache_cachedir = dirname(__DIR__) . '/.cache';
$_cache_cachefile = "$_cache_cachedir/" . sha1($_cache_file);

// Serve from the cache if it is younger than $cachetime and no orginal file exists or if the real file it is based on (if exists) has been updated
if (
  file_exists($_cache_cachefile) && 
  (
    (
      !isset($_cache_real_file) && 
      ((time() - $_cache_cachetime) < filemtime($_cache_cachefile))
    ) ||
    (
      isset($_cache_real_file) &&
      (filemtime($_cache_real_file) < filemtime($_cache_cachefile))
    )
  )
) {
  echo '<!-- Cached copy, generated ' . date('c', filemtime($_cache_cachefile)) . " -->\n";
  readfile($_cache_cachefile);
  exit;
}

ob_start(); // Start the output buffer
?>
