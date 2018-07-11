#!/usr/bin/env python

import os
def get_files(search_path):
     for (dirpath, _, filenames) in os.walk(search_path):
         for filename in filenames:
             yield os.path.join( filename)
list_files = get_files('../webapp/data')
for filename in list_files:
    print(filename)
