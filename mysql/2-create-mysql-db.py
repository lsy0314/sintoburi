#!/usr/bin/env python

# @author Hyeonjoon Lim
# @brief Create database
# @see https://www.tutorialspoint.com/python/python_database_access.htm

import MySQLdb
import config as cfg

# Connect to Mysql server
db = MySQLdb.connect(cfg.mysql['host'],cfg.mysql['user'],cfg.mysql['passwd'])

# Prepare a cursor object using cursor() method
cursor = db.cursor()

# Drop database if it already exist using execute() method.
sql = "DROP DATABASE IF EXISTS "+cfg.mysql['db']
cursor.execute(sql)

# Create database
sql = "CREATE DATABASE "+cfg.mysql['db']
cursor.execute(sql)

# Disconnect from Mysql server
db.close()
