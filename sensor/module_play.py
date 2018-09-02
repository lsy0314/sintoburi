#!/usr/bin/env python

# @Author: Hyunjun Lim
# @Date: Sep-02-2018
# @Title: module to play audio files and save bell_number value into db
# @License: Star

import os
import time
import MySQLdb
import config_sensor as cfg

def mysql_bell_number(audio_file):
    # @see https://www.tutorialspoint.com/python/python_database_access.htm
    # 1. find unique id (name_save field)
    # 2. save +1 (bell_number field) into database

    # Open database connection
    db = MySQLdb.connect(cfg.host,cfg.user,cfg.password,cfg.db)

    # Prepare a cursor object using cursor() method
    cursor = db.cursor()

    # Execute the SQL command: Add value 1 to bell_number field.
    print "[DEBUG] Inserting +1 into bell_number field of database"
    sql = "UPDATE `audio_table` SET bell_number = bell_number + 1 WHERE `audio_table`.`name_save` = '" + audio_file + "'"

    try:
       # Execute the SQL command
       cursor.execute(sql)
       # Commit your changes in the database
       db.commit()
    except:
       # Rollback in case there is any error
       db.rollback()

    # disconnect from database server
    db.close()

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
        
        #  Add the number of audio play into dtabase
        mysql_bell_number(audio_file)

        # wait for 2 seconds after play audio file.
        print "[DEBUG] Sleeping for specified seconds"
        time.sleep(2)

    else:
        print "[DEBUG] Failed."
        print "[DEBUG] We could not find audio files that have to be player with current time."
        # cmd = "mplayer ./pir_sound/wav/miss.wav"
        # cmd = "cvlc ./pir_sound/wav/miss.wav vlc://quit"
        os.system(cmd)
