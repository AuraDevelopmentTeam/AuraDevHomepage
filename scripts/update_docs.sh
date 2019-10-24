#! /bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Log these actions
. "$SCRIPT_DIR/log_helper.sh"

# Log header
echo
echo "Updating Documentation Repository!"
echo

# Check if directory is setup to use git
# Clone if not
# Pull if it is
if [ -d documentation ] && [ -d documentation/.git ]; then
  git -C documentation clean -fd
  git -C documentation reset --hard
  git -C documentation pull -f
else
  if [ -d documentation ]; then
    rm -rf documentation
  fi

  git clone https://github.com/AuraDevelopmentTeam/Documentation.git documentation
fi

# Log footer
echo "DONE!"
