#!/bin/bash
#variables
TEMP_PATH="/home/tomas/nette-test/script/temp"

#Args 1-9

#Clean up all temporary
echo '################################'
echo 'Clean up temporary files'
rm -rf  $TEMP_PATH
rm -rf "$TEMP_PATH"_copy $1 $2
