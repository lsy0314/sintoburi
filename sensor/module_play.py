#!/usr/bin/env python

# @Author: Hyunjun Lim
# @Date: Jul-21-2018
# @Title: module to play audio files
# @License: Star

import os

# check if an audio file at the current time, let's play audio file
# the time has to get number between 0 and 9 minutes
def play_audio_file(audio_file_time, current_time, search_path, audio_file):
    if (audio_file_time >= current_time and audio_file_time <= current_time+9):
        # play audo file
        # cmd = "mplayer ./pir_sound/wav/dingdong.wav"
        cmd = "mplayer " + search_path + audio_file
        print "[DEBUG] Succeeded, command: %s." % cmd
        print "[DEBUG] we found audio file."
        os.system(cmd)
    else:
        print "[DEBUG] Failed."
        print "[DEBUG] we could not find audio file."
        cmd = "mplayer ./pir_sound/wav/miss.wav"
        os.system(cmd)
