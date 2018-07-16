#!/usr/bin/env python

#
# @author Hyeonjoon Lim
# @brief a configuration file to manage variables
#
# A configuration file is to simply write a separate file
# that contains Python code
# @see https://hackernoon.com/4-ways-to-manage-the-configuration-in-python-4623049e841b

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
