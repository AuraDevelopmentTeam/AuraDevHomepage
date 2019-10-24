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
REPO_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." >/dev/null 2>&1 && pwd)"

# Start the script again with logging if running in interactive or daemon mode, else just continue
if [ "$MODE" != "passthrough" ]; then
  if [ "$MODE" == "interactive" ]; then
    # Log to file and print to screen
    logger="| tee --append"
  else
    # Just log to file
    logger=">>"
  fi

  log_file="$REPO_DIR/log/update.log"

  max_file_size=1024 # 1024 KiB = 1MiB
  max_line_count=10000

  file_size=$(du -k "$log_file" | tr -s '\t' ' ' | cut -d' ' -f1)

  # Rotate the log when it's too big
  # Also count lines late to improve performance (and it's readable anyways)
  if [ $file_size -gt $max_file_size ] || [ $(wc -l "$log_file") -gt $max_line_count ]; then
    savelog -p -J -9 -c 100 "$log_file"
  fi

  # Run script again (in passthrough mode) with logging
  eval "\"$0\" -p 2>&1 | ts -s '(%H:%M:%.S)]' 2>&1 | ts '[%Y-%m-%d %H:%M:%S' 2>&1 $logger \"$log_file\""
  exit $?
fi

# Make sure we are in the base dir
cd "$REPO_DIR"
