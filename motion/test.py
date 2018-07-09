#!/usr/bin/env python

import os
import time

# python can not play korean file name. So we have to write in english.
# TODO: we have to read audio files in ../webapp/sound/ folder automatically.
folder = "../webapp/sound/"
audio_file1 = "201808011710_shop1.wma"
audio_file2 = "201808011726_shop2.wma"
audio_file3 = "201808011749_shop3.wma"
audio_file4 = "201808011752_shop4.wma"
audio_file5 = "201808011807_shop5.wma"

print "[DEBUG] Starting..."   

print "[DEBUG] ---------------------------------"
# https://stackoverflow.com/questions/6677332/using-f-with-strftime-in-python-to-get-microseconds
current_time_ori = "201808011716"
# TODO: we ahve to cut last number
current_time_cut = 201808011710
# current_time = time.strftime("%Y%m%d%H%M")
print "[DEBUG] Current time is: %s" % current_time_ori

print "[DEBUG] ---------------------------------"
# TODO: check if a audio file at specified curretn_time, let's play audio file
audio_file1_time = 201808011710

# the time value has to get number between 0 and 9 minutes
if (audio_file1_time >= current_time_cut and audio_file1_time <= current_time_cut+9):
    cmd = "mplayer " + folder + audio_file1
    print "[DEBUG] Succeeded, command: %s" % cmd
    os.system(cmd)
else:
    print "[DEBUG] Failed, command."
   
