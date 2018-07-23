#!usr/bin/env python

import os

#This code is directory making code
def createFolder(directory):
    try:
        if not os.path.exists(directory):
            os.makedirs(directory)
    except OSError:
        print ('Error: Creating directory. ' +  directory)
        

# Example
#createFolder('./data/')
