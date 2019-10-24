#! /bin/bash

# Log these actions
. log_helper.sh

# Log header
echo
echo "Updating Base Repository!"

# Action
git documentation clean -fd
git documentation reset --hard
git documentation pull -f

# Log footer
echo "DONE!"
