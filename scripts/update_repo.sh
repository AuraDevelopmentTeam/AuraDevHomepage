#! /bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Log these actions
. "$SCRIPT_DIR/log_helper.sh"

# Log header
echo
echo "Updating Base Repository!"
echo

# Clean repo and pull updates
git clean -fd
git reset --hard
git pull -f

# Update/Setup the nginx config
"$SCRIPT_DIR/update_nginx_config.sh" -p | ts '    '

# Log footer
echo "DONE!"
