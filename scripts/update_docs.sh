#! /bin/bash

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
