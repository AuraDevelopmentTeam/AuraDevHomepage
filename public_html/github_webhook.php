<?php

// Connect to mysql
require_once '../includes/mysql_connection.php';

// Get page settings
require_once '../includes/get_settings.php';
$settings = loadSettings($conn);

if ((isset($_POST['payload']) && !empty($_POST['payload'])) && (isset($_SERVER['HTTP_X_HUB_SIGNATURE']) && !empty($_SERVER['HTTP_X_HUB_SIGNATURE']))) {
  // We got a payload. Let's verify!
  $hash = 'sha1=' . hash_hmac('sha1', file_get_contents('php://input'), $settings['github_secret']);
  if (strcmp($_SERVER['HTTP_X_HUB_SIGNATURE'], $hash) !== 0) {
    // Verification failed. So client is unauthorized!
    $error_code = 401;
    require 'error.php';
  }

  // At this point we can trust the payload
  $payload = json_decode($_POST['payload'], true);

  if ($payload['ref'] !== ('refs/heads/' . $settings['branch'])) {
    // 304 Not Modified
    http_response_code(304);
    die("Wrong branch\n");
  }

  // All ligths are green. Finally run script!
  echo shell_exec('../scripts/update_repo.sh -i 2>&1');
} else {
  // Let's pretend we don't exist
  $error_code = 404;
  require 'error.php';
}
