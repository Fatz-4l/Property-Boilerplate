#!/bin/bash
# ./acf-force-sync.sh

# Set script to exit on error
set -e

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to find theme root directory containing acf-json
find_theme_root() {
    local current_dir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
    local max_depth=10  # Maximum number of parent directories to check
    local depth=0

    while [ $depth -lt $max_depth ]; do
        # Check if acf-json exists in current directory
        if [ -d "$current_dir/acf-json" ]; then
            echo "$current_dir"
            return 0
        fi

        # Move to parent directory
        if [ "$current_dir" = "/" ]; then
            print_message "Error: Could not find acf-json directory in any parent directory!" "$RED"
            exit 1
        fi
        current_dir="$(dirname "$current_dir")"
        ((depth++))
    done

    print_message "Error: Exceeded maximum depth while searching for acf-json directory!" "$RED"
    exit 1
}

# Get the theme directory path by finding acf-json directory
THEME_DIR=$(find_theme_root)
ACF_JSON_DIR="$THEME_DIR/acf-json"
BACKUP_DIR="$ACF_JSON_DIR/backup"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

# Function to print messages
print_message() {
    echo -e "${2}${1}${NC}"
}

# Function to check if directory exists
check_directory() {
    if [ ! -d "$1" ]; then
        print_message "Error: Directory $1 does not exist!" "$RED"
        exit 1
    fi
}

# Function to check if there are JSON files
check_json_files() {
    if [ ! "$(ls -A $ACF_JSON_DIR/*.json 2>/dev/null)" ]; then
        print_message "Error: No JSON files found in $ACF_JSON_DIR" "$RED"
        exit 1
    fi
}

# Function to check if specific JSON file exists
check_specific_json_file() {
    if [ ! -f "$ACF_JSON_DIR/$1" ]; then
        print_message "Error: File $1 not found in $ACF_JSON_DIR" "$RED"
        exit 1
    fi
}

# Function to prompt for confirmation
confirm() {
    read -p "$(echo -e "${YELLOW}$1 [y/N]: ${NC}")" response
    case "$response" in
        [yY][eE][sS]|[yY]) 
            true
            ;;
        *)
            false
            ;;
    esac
}

# Function to list available JSON files
list_json_files() {
    print_message "\nAvailable ACF JSON files:" "$YELLOW"
    ls -1 "$ACF_JSON_DIR"/*.json | xargs -n 1 basename
}

# Main script
main() {
    print_message "Starting ACF Force Sync Script..." "$GREEN"
    
    # Check if required directories exist
    check_directory "$THEME_DIR"
    check_directory "$ACF_JSON_DIR"
    
    # Check if JSON files exist
    check_json_files
    
    # Create backup directory with timestamp
    BACKUP_DIR_WITH_TIME="$BACKUP_DIR/$TIMESTAMP"
    mkdir -p "$BACKUP_DIR_WITH_TIME"
    
    # Ask if user wants to backup a single file
    print_message "\nDo you want to backup a single ACF group file?" "$YELLOW"
    if confirm "Backup single file?"; then
        list_json_files
        print_message "\nEnter the filename of the ACF group to backup (including .json extension):" "$YELLOW"
        read json_filename
        
        # Validate file exists
        check_specific_json_file "$json_filename"
        
        # STEP 1: Backup single JSON file
        print_message "\nSTEP 1: Creating backup of single ACF JSON file..." "$YELLOW"
        cp "$ACF_JSON_DIR/$json_filename" "$BACKUP_DIR_WITH_TIME/"
        
        if [ $? -eq 0 ]; then
            print_message "Backup of $json_filename created successfully at $BACKUP_DIR_WITH_TIME" "$GREEN"
        else
            print_message "Error: Failed to create backup!" "$RED"
            exit 1
        fi
        
        # Move only the specific file to backup
        mv "$ACF_JSON_DIR/$json_filename" "$BACKUP_DIR_WITH_TIME/$(basename "$json_filename")"
    else
        # STEP 1: Backup all JSON files
        print_message "\nSTEP 1: Creating backup of all ACF JSON files..." "$YELLOW"
        cp "$ACF_JSON_DIR"/*.json "$BACKUP_DIR_WITH_TIME/"
        
        if [ $? -eq 0 ]; then
            print_message "Backup created successfully at $BACKUP_DIR_WITH_TIME" "$GREEN"
        else
            print_message "Error: Failed to create backup!" "$RED"
            exit 1
        fi
        
        # Move all files to backup
        for file in "$ACF_JSON_DIR"/*.json; do
            if [ -f "$file" ]; then
                mv "$file" "$BACKUP_DIR_WITH_TIME/$(basename "$file")"
            fi
        done
    fi
    
    # STEP 2: Prompt to delete existing ACF field groups
    print_message "\nSTEP 2: Delete existing ACF field groups" "$YELLOW"
    print_message "1. Go to WordPress Admin > Custom Fields" "$YELLOW"
    print_message "2. Delete all existing field groups" "$YELLOW"
    if ! confirm "Have you deleted all field groups in WordPress admin?"; then
        print_message "Please delete all field groups first and run the script again." "$RED"
        print_message "Your backup is safe at: $BACKUP_DIR_WITH_TIME" "$YELLOW"
        exit 1
    fi
    
    # STEP 3: Restore from backup
    print_message "\nSTEP 3: Restoring files from backup..." "$YELLOW"
    cp "$BACKUP_DIR_WITH_TIME"/*.json "$ACF_JSON_DIR/"
    
    if [ $? -eq 0 ]; then
        print_message "Files restored successfully" "$GREEN"
    else
        print_message "Error: Failed to restore files!" "$RED"
        print_message "You can manually copy files from: $BACKUP_DIR_WITH_TIME" "$YELLOW"
        exit 1
    fi
    
    # STEP 4: Cleanup
    print_message "\nSTEP 4: Cleaning up..." "$YELLOW"
    if confirm "Would you like to remove the backup folder?"; then
        rm -rf "$BACKUP_DIR"
        print_message "Backup folder removed successfully" "$GREEN"
    else
        print_message "Backup kept at: $BACKUP_DIR_WITH_TIME" "$YELLOW"
    fi
    
    print_message "\nACF Force Sync process completed!" "$GREEN"
    print_message "\nFINAL STEPS:" "$YELLOW"
    print_message "1. Go to WordPress Admin > Custom Fields" "$YELLOW"
    print_message "2. Click the 'Sync available' button at the top" "$YELLOW"
    print_message "3. Select all field groups" "$YELLOW"
    print_message "4. Click 'Sync changes'" "$YELLOW"
}

# Run the script
main 