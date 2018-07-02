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

#----------- Configuration area -------------------------------
folder = "/var/www/html/sintoburi/motion/"
GPIO_PIN = 4
count = 0
current_time = "morning\n"
condition_morn = "morning\n"
condition_afte = "afternoon\n"

#----------- Do not modify below statements -------------------

try:
    print "[DEBUG] Starting motion sensor..."

    # go to the default absolute path in order to read data file correctly
    os.chdir(folder)
    # motion sensor function probes the movement of people in front of entrance of the market.
    pir = MotionSensor(GPIO_PIN)
    while True:
        print "[DEBUG] Sleeping..."
        pir.wait_for_motion()
        count += 1
        t = time.localtime()
        print ("################# Motion Detected! (%d) %d:%d:%d ##############################" \
        % (count, t.tm_hour, t.tm_min, t.tm_sec))
	
        # if current weather is "Rain".
        if (current_time == condition_morn):
            cmd = "mplayer ../sound/wav/dingdong.wav"
            os.system(cmd)
        # if current weather is "Snow".
        elif(current_time == condition_afte):
            cmd = "mplayer ../sound/wav/dingdong.wav"
            os.system(cmd)
	else:
            cmd = "mplayer ../sound/wav/dingdong.wav"
            os.system(cmd)
        # wait for 5 seconds
        time.sleep(5)
# let's exit if users press "Ctrl + C".
except KeyboardInterrupt:
    print "Quit"
