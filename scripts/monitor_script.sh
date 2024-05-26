#!/bin/bash

#monitor script - set chmod +x
echo "################################"
date
echo
#runs list command , if file exist return of $? is 0
ls /var/run/httpd/httpd.pid

if [ $? -eq 0 ]
then
  echo "httpd process is running"
else
#  start process
  echo "httpd process is NOT running"
  echo "httpd process is starting"
  systmctl start httpd
  if [ $? -eq 0 ]
  then
    echo "process is started OK"
  else
    echo "process NOT started - Failed"
  fi
fi
echo "################################"
echo

#setup crontab -> crontab -e
# MM HH DOM mm DOW  COMMAND
#* * * * * monitor_script.sh &>> /var/log/monitor.txt - every minute every day, log output
