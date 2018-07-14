#!/usr/bin/env python

# @author Hyeonjoon Lim
# @brief Create tables
# @see https://www.tutorialspoint.com/python/python_database_access.htm

import MySQLdb
import config as cfg

# Open database connection
db = MySQLdb.connect(cfg.mysql['host'],cfg.mysql['user'],cfg.mysql['passwd'],cfg.mysql['db'])

# Prepare a cursor object using cursor() method
cursor = db.cursor()

# Drop table if it already exist using execute() method.
sql = "DROP TABLE IF EXISTS "+cfg.table1['name']
cursor.execute(sql)

# Run sql command
cursor.execute(cfg.table1['sql'])

# disconnect from server
db.close()
