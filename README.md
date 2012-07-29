BackMaid
========

BackMaid is a small PHP CLI script created to help keep backup-directories clean.

Only two settings right now are which directory to check and how many days back you want to save files. Default value is 200 days back, all files older then that will be marked for deletion.

Files will not be deleted just because you run the script. You will be asked to confirm before any deletion is done so the script can also be used for checking how many files would be deleted would you confirm.
