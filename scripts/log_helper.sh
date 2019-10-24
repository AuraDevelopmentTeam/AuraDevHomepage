#! /bin/bash

#############################################################################################################################
# ONLY CALL WITH "." OR "source"!!!                                                                                         #
#############################################################################################################################

# Detect the arguments the script is run with
if [ $# -eq 0 ]; then
  MODE=interactive
elif [ $# -eq 1 ]; then
  if [ "$1" == "-i" ]; then
    MODE=interactive
  elif [ "$1" == "-d" ]; then
    MODE=daemon
  elif [ "$1" == "-p" ]; then
    MODE=passthrough
  fi
fi

# Invalid usage
if [ -z "$MODE" ]; then
  echo -e "Invalid usage!\n\nUsage:\n\t$0 [-i|-d]" >&2
  exit 2
fi

# Get base dir
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Start the script again with logging if running in interactive or daemon mode, else just continue
if [ "$MODE" != "passthrough" ]; then
  if [ "$MODE" == "interactive" ]; then
    # Log to file and print to screen
    logger="| tee --append"
  else
    # Just log to file
    logger=">>"
  fi

  # Run script again (in passthrough mode) with logging
  eval "\"$0\" -p 2>&1 | ts -s '(%H:%M:%.S)]' 2>&1 | ts '[%Y-%m-%d %H:%M:%S' 2>&1 $logger \"$DIR/../log/update.log\""
  exit $?
fi
