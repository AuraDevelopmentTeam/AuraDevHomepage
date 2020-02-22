#! /bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Log these actions
. "$SCRIPT_DIR/log_helper.sh"

# Log header
echo
echo "Setting up the repository!"
echo

# Copy git hooks
cp -afv .hooks/* .git/hooks/

# Update/Setup the docs
"$SCRIPT_DIR/update_docs.sh" -p | ts '    '
# Update/Setup the nginx config
"$SCRIPT_DIR/update_nginx_config.sh" -p | ts '    '

# Log footer
echo "DONE!"
