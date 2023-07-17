#!/bin/bash
  sleep 15
curl -H 'Content-Type: application/x-ndjson' -XPOST 'YOUR_SERVER_ADDRESS:9200/users/_bulk?pretty' --data-binary @users.json

curl -H 'Content-Type: application/x-ndjson' -XPOST 'YOUR_SERVER_ADDRESS/users_posts/_bulk?pretty' --data-binary @user_posts.json




