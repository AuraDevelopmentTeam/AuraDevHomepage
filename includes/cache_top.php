<?php
// Allow invoker to override the file name
if (!isset($file)) $file = $_SERVER['REQUEST_URI'];
$cachefile = dirpath(__DIR__) . '/cache/' . sha1($file);
$cachetime = 18000; // 5 hours

// Serve from the cache if it is younger than $cachetime and no orginal file exists or if the real file it is based on (if exists) has been updated
if (
  file_exists($cachefile) && 
  (
    (
      !isset($real_file) && 
      ((time() - $cachetime) < filemtime($cachefile))
    ) ||
    (
      isset($real_file) &&
      (filemtime($real_file) < filemtime($cachefile))
    )
  )
) {
  echo '<!-- Cached copy, generated ' . date('c', filemtime($cachefile)) . " -->\n";
  readfile($cachefile);
  exit;
}

ob_start(); // Start the output buffer
?>
