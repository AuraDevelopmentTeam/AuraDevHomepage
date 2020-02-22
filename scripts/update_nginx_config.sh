#! /bin/bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"

# Log these actions
. "$SCRIPT_DIR/log_helper.sh"

# Log header
echo
echo "Updating nginx Config!"
echo

# Load settings or ask for them
cd nginx

if [ -f variables.conf ]; then
  # If the settings file exits, use it
  . variables.conf
elif [ -t 0 ]; then
  # No values found but able to ask the user
  # Ask user for values
  # TODO: Make values inputable properly (ts messes with read)
  read -p "Domain: " -e DOMAIN
  read -p "Base Name: " -e -i "$(basename "$REPO_DIR")" BASE_NAME

  # Save values
  echo "${DOMAIN@A}" > variables.conf
  echo "${BASE_NAME@A}" >> variables.conf
else
  # We are not interactive and can't ask for the values...
  echo "Error: No configured values in \"$(pwd)/variables.conf\" and no interactive shell is open"
  echo "Try creating the file by running the script \"${BASH_SOURCE[0]}\" interactively"
  exit 1
fi

if [ -z "$DOMAIN" ] || [ -z "$BASE_NAME" ]; then
  # Not all config values are set
  echo "Error: Missing config values in \"$(pwd)/variables.conf\""
  echo "Try recreating the file by deleting it first and then running the script \"${BASH_SOURCE[0]}\""
  exit 1
fi

IPv4="$(dig +short A "$DOMAIN" | tail -n1)"
IPv6="$(dig +short AAAA "$DOMAIN" | tail -n1)"

echo "${IPv4@A}"
echo "${IPv6@A}"
echo "${DOMAIN@A}"
echo "${BASE_NAME@A}"
echo "${REPO_DIR@A}"

# Update/create nginx config
cp -afv config.template.conf config.conf
sed \
  -e "s/<IPv4>/$IPv4/g" \
  -e "s/<IPv6>/$IPv6/g" \
  -e "s/<Domain>/$DOMAIN/g" \
  -e "s/<BaseName>/$BASE_NAME/g" \
  -e "s@<RootDir>@$REPO_DIR@g" \
  config.template.conf > config.conf

# Log footer
echo "DONE!"
