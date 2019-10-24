#! /bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Log these actions
. "$SCRIPT_DIR/log_helper.sh"

# Log header
echo
echo "Setting up the repository!"
echo

# Update/Setup the docs
. "$SCRIPT_DIR/update_docs.sh"

# Log footer
echo "DONE!"
