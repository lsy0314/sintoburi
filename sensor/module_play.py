#!/usr/bin/env python

# @Author: Hyunjun Lim
# @Date: Jul-21-2018
# @Title: module to play audio files
# @License: Star

import os
import time

# check if an audio file at the current time, let's play audio file
# the time has to get number between 0 and 9 minutes
def play_audio_file(audio_file_time, current_time, search_path, audio_file):
    if (audio_file_time >= current_time and audio_file_time <= current_time+9):
        # Note that mplayer is not good in RPI3. It results in "Audio device got stuck!" error.
        # audio out options of mplayer: -ao alsa , -ao pluse
        # cmd = "mplayer -ao pulse " + search_path + audio_file
        cmd = "cvlc " + search_path + audio_file + " vlc://quit"
        print "[DEBUG] Succeeded, command: %s." % cmd
        print "[DEBUG] We found audio file."
        print "[DEBUG] Let's play the audio file:" , cmd
        os.system(cmd)
        # wait for 2 seconds after play audio file.
        time.sleep(2)

    else:
        print "[DEBUG] Failed."
        print "[DEBUG] We could not find audio files that have to be player with current time."
        # cmd = "mplayer ./pir_sound/wav/miss.wav"
        # cmd = "cvlc ./pir_sound/wav/miss.wav vlc://quit"
        os.system(cmd)
