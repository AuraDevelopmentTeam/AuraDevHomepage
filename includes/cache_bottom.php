<?php
// Create cache dir if not exists
mkdir(dirname($cachefile), 0777, true);
// Cache the contents to a cache file
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
?>
