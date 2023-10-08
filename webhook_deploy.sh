#!/bin/bash

while true; do
  {
    # Read the request headers line by line
    while IFS= read -r line; do
      # Check if the line contains the "Authorization" header
      if [[ $line == *"Authorization: Bearer $VALID_KEY"* ]]; then
        authorized="true"
      fi

      # Log the request headers
      echo "$line"

      # Check for an empty line, indicating the end of headers
      if [[ -z "$line" ]]; then
        break
      fi
    done

    # Check if the request is authorized based on the "Authorization" header
    if [[ "$authorized" == "true" ]]; then
      echo -ne "HTTP/1.1 200 OK\r\n\r\n"
      # Run the deploy.sh script
      ./deploy.sh
    else
      echo -ne "HTTP/1.1 401 Unauthorized\r\n\r\n"
    fi
  } | nc -l -p 9991 -q 1
done
