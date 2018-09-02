#!/usr/bin/env python

# @author Hyeonjoon Lim
# @brief insert bell_number to database
# @see https://www.tutorialspoint.com/python/python_database_access.htm

import MySQLdb
import config as cfg

# Open database connection
db = MySQLdb.connect("localhost","root","ggghhh03","sbdb")

# Prepare a cursor object using cursor() method
cursor = db.cursor()

# Execute the SQL command
sql = "UPDATE `audio_table` SET bell_number = bell_number + 1 WHERE `audio_table`.`name_save` = '201809021250_ff97e08eba613f7ea618b17c59d5673a.m4a'"

try:
   # Execute the SQL command
   cursor.execute(sql)
   # Commit your changes in the database
   db.commit()
except:
   # Rollback in case there is any error
   db.rollback()

# disconnect from server
db.close()
