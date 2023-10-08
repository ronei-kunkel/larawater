#!/bin/bash

while true; do
  request=""
  { 
    # Check if the request is not null and then log it
    if [[ -n "$request" ]]; then
      echo -e "Request:\n$request"
    fi
  } | nc -l -p 9991 -q 1
done
