#!/bin/bash

while true; do
  request=""
  { 
    # Read the incoming request line by line and store it in the "request" variable
    while IFS= read -r line; do
      request="$request$line"$'\n'
    done

    # Check if the request is not null and then log it
    if [[ -n "$request" ]]; then
      echo -e "Request:\n$request"
    fi
  }
done
