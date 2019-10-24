<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  echo shell_exec('scripts/update_repo.sh -i 2>&1');
}
