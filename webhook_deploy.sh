#!/bin/bash

while true; do
  { 
    read -r request
    if [[ $request == *"Authorization: Bearer $VALID_KEY"* ]]; then
      echo -ne "HTTP/1.1 200 OK\r\n\r\n"
      # Run the deploy.sh script
      ./deploy.sh
    else
      echo -ne "HTTP/1.1 401 Unauthorized\r\n\r\n"
    fi
  } | nc -l -p 9991 -q 1
done
