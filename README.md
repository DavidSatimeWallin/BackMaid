BackMaid
========

BackMaid is a small PHP CLI script created to help keep backup-directories clean.

Only two settings right now are which directory to check and how many days back you want to save files. Default value is 200 days back, all files older then that will be marked for deletion.

Files will not be deleted just because you run the script. You will be asked to confirm before any deletion is done so the script can also be used for checking how many files would be deleted would you confirm.

How to use?
-----------

Simply glone this repository, edit backmaid.php to set which directory to use and then **/usr/bin/php /path/to/backmaid.php** to run the script.

Requirements?
-------------

The only requirements should be php5-cli

License?
--------
This program is free software. It comes without any warranty, to
the extent permitted by applicable law. You can redistribute it
and/or modify it under the terms of the Do What The Fuck You Want
To Public License, Version 2, as published by Sam Hocevar. See
http://sam.zoy.org/wtfpl/COPYING for more details.
