#!/bin/bash

# Change to the directory where you want to deploy the files
cd /var/www/test-project

# Pull the latest changes from GitHub
git pull origin docker

# Any additional deployment steps (e.g., restarting services)
# ...
