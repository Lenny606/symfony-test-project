#!/bin/bash
#### enhanced by ChatGPT
#Variables: Defined variables for directories, URLs, and file paths to avoid hardcoding and make the script more maintainable.
#Functions: Used functions to organize the script into logical sections.
#Error Checking: Added a check_command function to ensure each command succeeds before proceeding.
#Quiet Mode: Used -q with wget and unzip for a quieter output, redirecting unnecessary output to /dev/null.


# Variables
TOOLS=("unzip" "wget")
TEMP_DIR="temp/file"
TEMP_COPY_DIR="temp_copy/file"
ZIP_URL="https://www.tooplate.com/zip-templates/2137_barista_cafe.zip"
ZIP_FILE="${TEMP_DIR}/2137_barista_cafe.zip"
DEST_DIR="/home/tomas/nette-test/script/temp_copy/file"

# Function to check if a command was successful
check_command() {
    if [ $? -ne 0 ]; then
        echo "Error: $1 failed. Exiting."
        exit 1
    fi
}

# Function to install required tools
install_tools() {
    echo 'Installing tools'
    sudo apt update -y > /dev/null
    for tool in "${TOOLS[@]}"; do
        sudo apt install "$tool" -y > /dev/null
        check_command "Installing $tool"
    done
    echo '################################'
    echo
}

# Function to create directories and set permissions
create_directories() {
    echo 'Making directories'
    mkdir -p "$TEMP_DIR" "$TEMP_COPY_DIR"
    check_command "Creating directories"
    echo 'Setting permissions'
    chmod 777 "$TEMP_DIR" "$TEMP_COPY_DIR"
    check_command "Setting permissions"
    echo '################################'
    echo
}

# Function to download and unzip the file
download_and_unzip() {
    echo 'Switching to temp/file directory'
    cd "$TEMP_DIR" || exit
    check_command "Changing directory to $TEMP_DIR"
    echo '################################'
    echo

    echo 'Getting file'
    wget -q "$ZIP_URL" -O "$ZIP_FILE"
    check_command "Downloading file"
    echo '################################'
    echo

    echo 'Unzipping file'
    unzip -q "$ZIP_FILE"
    check_command "Unzipping file"
    cp -r 2137_barista_cafe/* "$DEST_DIR"
    check_command "Copying files"
    echo '################################'
    echo
}

# Function to clean up temporary files
clean_up() {
    echo 'Clean up'
    rm -rf "$TEMP_DIR"
    check_command "Cleaning up"
    echo '################################'
    echo
}

# Function to show the result
show_result() {
    echo 'Result'
    ls "$DEST_DIR"
    check_command "Listing directory"
}

# Main script execution
install_tools
create_directories
download_and_unzip
clean_up
show_result
