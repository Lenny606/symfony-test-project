# Scripts

## setup permissions
```
chmod +x file
```
## run script
with full path 
```
/home/tomas/symfony-test/scripts/script.sh
```

## troubleshooting
if bad interpreter run:
```
sed -i -e 's/\r$//' scriptname.sh
```
The command will replace those CR characters with nothing, \
which will leave these lines with LF (\n) as the ending,\
and Bash will be able to read and execute the file by running