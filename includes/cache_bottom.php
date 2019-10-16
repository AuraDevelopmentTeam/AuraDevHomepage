<?php
// Create cache dir if not exists
if (!file_exists($_cache_cachedir)) {
  mkdir($_cache_cachedir, 0777, true);
}
// Cache the contents to a cache file
$_cache_cachestore = fopen($_cache_cachefile, 'w');
fwrite($_cache_cachestore, ob_get_contents());
fclose($_cache_cachestore);
ob_end_flush(); // Send the output to the browser
?>
