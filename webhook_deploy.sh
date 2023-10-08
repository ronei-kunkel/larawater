#!/bin/bash

while true; do
  # Listen for incoming connections on port 9991
  { echo -ne "HTTP/1.1 200 OK\r\n\r\n"; } | nc -l -p 9991 -q 1

  # Run the deploy.sh script
  ./deploy.sh
done
