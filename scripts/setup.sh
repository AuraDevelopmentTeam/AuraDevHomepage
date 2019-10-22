#! /bin/bash

# Get base dir
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Move to base directory
cd "$DIR/.."

# Update/Setup the docs
"$DIR/update_docs.sh"
