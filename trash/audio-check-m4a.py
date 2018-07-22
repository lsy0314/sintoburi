#!/usr/bin/env python

import re

# check a string to know if the file name includes  a special character
# https://stackoverflow.com/questions/19970532/how-to-check-a-string-for-a-special-character
filename = "201807051345.png"
if re.match(".*.m4a$", filename):
   print "Valid. This file is *.m4a audio file."
else:
   print "Invalid. THis file is not *.m4a audio file."

