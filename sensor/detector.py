#!/usr/bin/env python

# @Author: Hyunjun Lim
# @Date: Jul-02-2018
# @Title: Motion Probing Software with PIR sensor
# @License: Star
# @Prequisites:
# $ sudo apt install python-mysqldb
# $ sudo apt install mplayer vlc
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

import config_sensor as cfg
from module_play  import play_audio_file
 
#----------- Do not modify below statements -------------------
try:
    print "[DEBUG] Starting PIR motion sensor..."

    # go to the default absolute path in order to read data file correctly
    os.chdir(cfg.folder)
    # motion sensor function probes the movement of people in front of entrance of the market.
    pir = MotionSensor(cfg.GPIO_PIN)
    count = 0
    while True:
        print "[DEBUG] Wait for probing the movement of people..."
        # wait for until customer wil be appeared
        pir.wait_for_motion()
        count += 1
        t = time.localtime()
        print ("################# Motion Detected! (%d) %d:%d:%d ##############################" \
        % (count, t.tm_hour, t.tm_min, t.tm_sec))
        #get time information with strftime fucntion for time acess and conversions
        #https://docs.python.org/2/library/time.html
        current_day = time.strftime("%Y%m%d")

        print "[DEBUG] Reading audio files..."
        #---------------------------------------------- Read audio file folder: start	
        # Note that python can not play korean file name. So we have to write in english.
        # we have to read audio files in the search_path automatically.
        # declare a directory to search audio files
        search_path = cfg.search_path + current_day + "/"
        
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
            audio_file = filename
            print "[DEBUG] Original audio file name (string) is ", audio_file
            filename = filename[:12]
            print "[DEBUG] Changed  audio file name (string) is ", filename

            # Check if a String is a number or a characters in Python with str.isdigit() 
            check = filename.isdigit()
            print "[DEBUG] check vaule is", check

            # Note that you have to use False instead of "False" word. Do not use "(double quotation mark).
            if (check == False):
                print "[DEBUG] Failed. The file name is not number."
                print "[DEBUG] You have to change file name with only a number without a character."
                print "[DEBUG] So, we run 'continue' statement."
                # sys.exit()
                continue
            else: 
                print "[DEBUG] Okay. The file name is number."

            # check a string to know if the file name includes  a special character
	    # https://stackoverflow.com/questions/19970532/how-to-check-a-string-for-a-special-character
	    if re.match(".*.m4a$", audio_file):
                print "[DEBUG] Okay. This file is .m4a audio file."
            else:
	        print "[DEBUG] Oooops. This file is not .m4a audio file."
                print "[DEBUG] You have to save .m4a audio file only."
                print "[DEBUG] So, we run 'continue' statement."
                #sys.exit()
                continue
            # we fetch date/time with number only from file name.
            # If the value  is not date/time format such as 201808011710, program can not run.
            audio_file_time = int(filename)
            print "[DEBUG] Changed  audio file name (int)    is ", audio_file_time
        
            print "[DEBUG] Starting..."
            print "[DEBUG] ---------------------------------"
        
            # we cut last number from original time. Then, append '0" number.
            # https://stackoverflow.com/questions/6677332/using-f-with-strftime-in-python-to-get-microseconds
            current_time = int(time.strftime("%Y%m%d%H%M"))
            current_time = (current_time / 10) * 10
            #if we have to do a debuging , lets declare timedata directly.
            #current_time = 201808051420
        
            print "[DEBUG] audio_time %s, current time %d" % (audio_file_time , current_time)
            print "[DEBUG] ---------------------------------"
 
            # if audio file time is not current time (e.g. 00 ~ 09), let's skip play_audio_file() function. 
            if (audio_file_time >= current_time and audio_file_time <= current_time+9): 
                # run play_audio_file() function from module_play.py  file.
                play_audio_file (audio_file_time, current_time, search_path, audio_file)

        # wait for 5 seconds after finishing 'for' statement
        time.sleep(cfg.play_break_time_sec)
        print "[DEBUG]---- audio file list: end --------------"
        #---------------------------------------------- Read audio file folder: end

# let's exit if users press "Ctrl + C".
except KeyboardInterrupt:
    print "Quit"
