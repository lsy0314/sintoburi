#!/usr/bin/env python

import os

# declare a directory to search audio files
search_path="../webapp/sound/"

# function to display audio files in a folder
# https://stackoverflow.com/questions/3207219/how-do-i-list-all-files-of-a-directory
def get_files(path):
    # read files in the folder with os.walk() function   
    for (dirpath, _, filenames) in os.walk(search_path):
        # get file list with "folder/filename" structure
        for filename in filenames:
            # combine folder name + file name per a file
            # yield os.path.join(dirpath, filename)
            yield os.path.join(filename)

# get file list with generator object format via get_files() function
list_files = get_files(search_path)
print "[DEBUG] ",list_files

# display all audio file name sequentially
print "[DEBUG]---- file list --------------"
for filename in list_files:
    # cut the existing filae name with 12 characters
    filename = filename[:12]
    print(filename)
print "[DEBUG]-----------------------------"
