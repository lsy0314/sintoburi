#!/usr/bin/env python

# A configuration file is to simply write a separate file
# that contains Python code

mysql = {"host"  : "localhost",
         "user"  : "root",
         "passwd": "ggghhh03",
         "db"    : "sbdb1"
        }

# Create table as per requirement
table1 = {"name": "upload_file",
          "sql" : """CREATE TABLE upload_file (
                  file_id   VARCHAR(255) NOT NULL PRIMARY KEY,
                  name_orig VARCHAR(255),
                  name_save VARCHAR(255),
                  reg_time  TIMESTAMP NOT NULL
                  )"""
         }
