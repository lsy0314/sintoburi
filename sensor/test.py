#!/usr/bin/env python

import os
import time

# python can not play korean file name. So we have to write in english.
# TODO: we have to read audio files in ../webapp/sound/ search_path automatically.
# search_path = "../webapp/sound/"
# audio_file1 = "201808011710_shop1.m4a"
# audio_file2 = "201808011726_shop2.m4a"
# audio_file3 = "201808011749_shop3.m4a"
# audio_file4 = "201808011752_shop4.m4a"
# audio_file5 = "201808011807_shop5.m4a"


# declare a directory to search audio files
search_path="../webapp/audio_test/"

# function to display audio files in a search_path
# https://stackoverflow.com/questions/3207219/how-do-i-list-all-files-of-a-directory
def get_files(path):
    # read files in the search_path with os.walk() function
    for (dirpath, _, filenames) in os.walk(search_path):
        # get file list with "search_path/filename" structure
        for filename in filenames:
            # combine search_path name + file name per a file
            # yield os.path.join(dirpath, filename)
            yield os.path.join(filename)

# get file list with generator object format via get_files() function
list_files = get_files(search_path)
print "[DEBUG] ",list_files

# display all audio file name sequentially
print "[DEBUG]---- file list: start--------------"
for filename in list_files:
    # cut the existing filae name with 12 characters
    audio_file1 = filename
    filename = filename[:12]
    print(filename)
    
    # we fetch date/time with number only from file name.
    # The number 12 means date/time such as 201808011710.
    # audio_time_file1 = int(audio_file1[:12])
    audio_time_file1 = int(filename)
    
    print "[DEBUG] Starting..."
    print "[DEBUG] ---------------------------------"
    
    # we cut last number from original time
    # https://stackoverflow.com/questions/6677332/using-f-with-strftime-in-python-to-get-microseconds
    current_time = int(time.strftime("%Y%m%d%H%M"))
    #current_time = (current_time / 10) *10
    current_time = 201808051420
    
    print "[DEBUG] audio_time %s, current time %d" % (audio_time_file1 , current_time)
    print "[DEBUG] ---------------------------------"
    
    # check if an audio file at the current time, let's play audio file
    # the time has to get number between 0 and 9 minutes
    if (audio_time_file1 >= current_time and audio_time_file1 <= current_time+9):
        cmd = "mplayer " + search_path + audio_file1
        print "[DEBUG] We found audio file."
        print "[DEBUG] Succeeded, command: %s." % cmd
        os.system(cmd)
    else:
        print "[DEBUG] we could not find audio file."
        print "[DEBUG] Failed, command."
   
print "[DEBUG]---- file list: end --------------"
    
