#!/usr/bin/env python

# @Author: Hyunjun Lim
# @Date: Jul-02-2018
# @Title: Motion Probing Software with PIR sensor
# @License: Star
# @Prequisites:
# $ sudo apt install mplayer
# $ sudo pip install gpiozero
#
# @Caution:
# 1. Check (a)location of +DC voltage and (b)GND line on Raspberry Pi3 board
# 2. Change (a)sensor and (b)pulse button [orange color] appropriately
#
# How to run program with root privilege:
# $ sudo visudo 
#  # User privilege specification
#    root            ALL=(ALL:ALL) ALL
#    hjoon0510       ALL=NOPASSWD: ALL
# $ ./pir-sensor.py
#
# Reference:
# 1. http://gpiozero.readthedocs.io/en/stable/recipes.html
# 2. http://raspi.tv/2015/gpio-zero-test-drive-making-light-of-security

# import motion sensor function
from gpiozero import MotionSensor
# import time and os function
import time
import os
import sys
import re

#----------- Configuration area -------------------------------
import config_sensor as cfg
 
#----------- Do not modify below statements -------------------

try:
    print "[DEBUG] Starting PIR motion sensor..."

    # go to the default absolute path in order to read data file correctly
    os.chdir(cfg.folder)
    # motion sensor function probes the movement of people in front of entrance of the market.
    pir = MotionSensor(cfg.GPIO_PIN)
    count = 0
    while True:
        print "[DEBUG] Sleeping..."
        # wait for until customer wil be appeared
        pir.wait_for_motion()
        count += 1
        t = time.localtime()
        print ("################# Motion Detected! (%d) %d:%d:%d ##############################" \
        % (count, t.tm_hour, t.tm_min, t.tm_sec))
        
        print "[DEBUG] Reading audio files..."
        #---------------------------------------------- Read audio file folder: start	
        # Note that python can not play korean file name. So we have to write in english.
        # we have to read audio files in the search_path automatically.
        # declare a directory to search audio files
        search_path=cfg.search_path
        
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
        print "[DEBUG]---- audio file list: start--------------"
        for filename in list_files:
            # cut the existing file name with 12 characters
            # for example, 201808151130_food_store.m4a --> 201805151130
            print "#############################################################################"
            audio_file1 = filename
            print "[DEBUG] Original audio file name (string) is ", audio_file1
            filename = filename[:12]
            print "[DEBUG] Changed  audio file name (string) is ", filename

            # Check if a String is a number or a characters in Python with str.isdigit() 
            check = filename.isdigit()
            print "[DEBUG] check vaule is", check

            # Note that you have to use False instead of "False" word. Do not use "(double quotation mark).
            if (check == False):
                print "[DEBUG] Failed. The file name is not number."
                print "[DEBUG] You have to change file name with number."
                sys.exit()
            else: 
                print "[DEBUG] Okay. The file name is number."

            # check a string to know if the file name includes  a special character
	    # https://stackoverflow.com/questions/19970532/how-to-check-a-string-for-a-special-character
	    if re.match(".*.m4a$", audio_file1):
                print "[DEBUG] Valid. This file is *.m4a audio file."
	    else:
	        print "[DEBUG] Invalid. THis file is not *.m4a audio file."
                print "[DEBUG] You have to save *.m4a audio file only." 
                sys.exit()
            cfg.execution_num = cfg.execution_num + 1
  	    print "[DEBUG] check execution number", cfg.execution_num
            # we fetch date/time with number only from file name.
            # If the value  is not date/time format such as 201808011710, program can not run.
            audio_time_file1 = int(filename)
            print "[DEBUG] Changed  audio file name (int)    is ", audio_time_file1
        
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
                # play audo file
                # cmd = "mplayer ./pir_sound/wav/dingdong.wav"
                cmd = "mplayer " + search_path + audio_file1
                print "[DEBUG] Succeeded, command: %s." % cmd
                print "[DEBUG] we found audio file."
                os.system(cmd)
            else:
                print "[DEBUG] Failed."
                print "[DEBUG] we could not find audio file."
                cmd = "mplayer ./pir_sound/wav/miss.wav"
                os.system(cmd)
            # wait for 5 seconds in 'for' statement
            time.sleep(5)
        print "[DEBUG]---- audio file list: end --------------"
        #---------------------------------------------- Read audio file folder: end

# let's exit if users press "Ctrl + C".
except KeyboardInterrupt:
    print "Quit"
