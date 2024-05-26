#!/bin/bash
#variables
PACKAGE="unzip"
URL="https://www.tooplate.com/zip-templates/2137_barista_cafe.zip"

#Install tools
echo 'Installing tools'
sudo apt install $PACKAGE -y > /dev/null
echo '################################'
echo
#Make dirs
echo 'Making directories'
mkdir -p temp/file
mkdir -p temp_copy/file
echo 'Setting perms'
chmod 777 temp/file
chmod 777 temp_copy/file
echo '################################'
echo
#Switch
echo 'Switching to temp/file directory'
cd temp/file
echo '################################'
echo
#Get files, unzip and copy

echo 'getting file'
wget $URL > /dev/null
echo
echo '################################'
echo 'unzipping file'
unzip 2137_barista_cafe.zip > /dev/null
cp -r 2137_barista_cafe/* /home/tomas/nette-test/script/temp_copy/file

#Clean up
echo '################################'
echo 'Clean up'
rm -rf /home/tomas/nette-test/script/temp

echo '################################'
echo 'result'
ls /home/tomas/nette-test/script/temp_copy/file