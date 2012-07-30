BackMaid
========

BackMaid is a small PHP CLI script created to help keep backup-directories clean.

Only two settings right now are which directory to check and how many days back you want to save files. Default value is 200 days back, all files older then that will be marked for deletion.

Files will not be deleted just because you run the script. You will be asked to confirm before any deletion is done so the script can also be used for checking how many files would be deleted would you confirm.

Functions
---------

BackMaid will query given directory for files older than the timespan you've setup. It will then present the stats of its results to you with how many files the directory contains, how many files it wants to delete and how much space will be freed up should you choose to actually remove the files.

BackMaid will not remove any files without confirmation from you after getting the results. This means that you will first be presented with the results of its queries and then you have to confirm that you want to delete presented files.

How to use
-----------

Simply glone this repository, edit backmaid.php to set which directory to use and then **/usr/bin/php /path/to/backmaid.php** to run the script.

Requirements
-------------

The only requirements should be a UNIX -like system and php5-cli

License
--------
This program is free software. It comes without any warranty, to
the extent permitted by applicable law. You can redistribute it
and/or modify it under the terms of the Do What The Fuck You Want
To Public License, Version 2, as published by Sam Hocevar. See
http://sam.zoy.org/wtfpl/COPYING for more details.
