#!/bin/bash
#variables
FREE_RAM=$(free -m | grep Mem | awk '{print $4}')
LOAD=`uptime | awk '{print $9}'`
ROOT_FREE=$(df -h | grep '/dev/sda' | awk '{print $4}')
ARRAY_OF_NAMES="JON BON BEN MAX"
COUNTER=0

#Args 1-9
#Input
echo "Enter number: "
read NUMBER
echo "You have entered $NUMBER"

read -p 'name: ' NAME
#Clean up all temporary
echo "Welcome $USER on $HOSTNAME."
echo '################################'
echo "Available Ram is $FREE_RAM"
echo '################################'
echo "Current load is $LOAD"
echo '################################'
echo "ROOT partition $ROOT_FREE"

echo "################################"
echo "Looping....."

for NAMEUSR in $ARRAY_OF_NAMES
do
  sleep 1
  echo "name is: $NAMEUSR"
done

while [ $COUNTER -lt $NUMBER ]
do
  echo "weeeeeeeeeeeeeeeeeeeeeeeeeeeeeee"
  COUNTER=$(($COUNTER + 1))
done

if [ $NUMBER -gt 10 ]
then
  sleep 5
  echo "Your Lucky $NUMBER for $NAME"
elif [ $NUMBER -gt 5 ]
then
  echo "You have $NUMBER"
else
  echo "You have nothing"
fi