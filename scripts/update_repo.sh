#! /bin/bash

# Log these actions
. log_helper.sh

# Log header
echo
echo "Updating Base Repository!"

# Action
git clean -fd
git reset --hard
git pull -f

# Log footer
echo "DONE!"
