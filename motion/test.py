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


# we fetch date/time with number only from file name.
# The number 12 means date/time such as 201808011710.
audio_time_file1 = int(audio_file1[:12])

print "[DEBUG] Starting..."
print "[DEBUG] ---------------------------------"

# we cut last number from original time
# https://stackoverflow.com/questions/6677332/using-f-with-strftime-in-python-to-get-microseconds
current_time = int(time.strftime("%Y%m%d%H%M"))
#current_time = (current_time / 10) *10
current_time = 201808011730

print "[DEBUG] audio_time %s, current time %d" % (audio_time_file1 , current_time)
print "[DEBUG] ---------------------------------"

# check if an audio file at the current time, let's play audio file
# the time has to get number between 0 and 9 minutes
if (audio_time_file1 >= current_time and audio_time_file1 <= current_time+9):
    cmd = "mplayer " + folder + audio_file1
    print "[DEBUG] We found audio file."
    print "[DEBUG] Succeeded, command: %s." % cmd
    os.system(cmd)
else:
    print "[DEBUG] we could not find audio file."
    print "[DEBUG] Failed, command."
   
