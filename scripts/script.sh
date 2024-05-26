#!/bin/bash

### Script for basic information about system ###
echo "Hello and welcome"
echo

#uptime
echo '#############################'
echo "Uptime of the system is:"
uptime

#memory
echo '#############################'
echo "Memory of the system is:"
free -m

#disk
echo '#############################'
echo "Disk of the system is:"
df -h
