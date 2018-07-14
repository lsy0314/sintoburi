#!/usr/bin/env python

# @author Hyeonjoon Lim
# @brief Check the connection to Mysql server
# @see https://www.tutorialspoint.com/python/python_database_access.htm

import MySQLdb
import config as cfg

# Open database connection
db = MySQLdb.connect(cfg.mysql['host'],cfg.mysql['user'],cfg.mysql['passwd'])

# prepare a cursor object using cursor() method
cursor = db.cursor()

# execute SQL query using execute() method.
cursor.execute("SELECT VERSION()")

# Fetch a single row using fetchone() method.
data = cursor.fetchone()
print "Database version : %s " % data

# disconnect from server
db.close()
