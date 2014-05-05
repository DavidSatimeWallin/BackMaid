<?php

/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://sam.zoy.org/wtfpl/COPYING for more details.
*/

    # ###################################### #
    # SETTINGS                               #
    # ###################################### #

    /*
     * $directory are the directory you want to clean
     * DO NOT FORGET THE TRAILING SLASH
     */
        $directory = $argv[ 1 ];

    /*
     * $number_of_days are the amount of days to keep.
     * 200 days are the default value and any file older
     * then that will be set for deletion.
     * Please note that every file is checked against last
     * modification date and not creation date.
     */
        if ( !$argv[ 2 ] || !is_numeric( $argv[ 2 ] ) )
        {
          $number_of_days = 200;
        } else
        {
          $number_of_days = $argv[ 2 ];
        }
        

    $timespan = time( )-( $number_of_days*24*60*60 );
    $time_limit = date( "Ymd", $timespan );


    function fnListFiles( $root_dir, $files )
    {
        global $time_limit;
        if ( $handle = opendir( $root_dir ) )
        {
          while ( FALSE !== ( $file = readdir( $handle ) ) )
          {
            if ( $file != "." && $file != ".." )
            {
              $strNewPath=$root_dir."/".$file;
              if( is_file( $strNewPath ) )
              {
                $strExtention = explode( ".", $strNewPath );
                if( end( $strExtention ) == 'gz' )
                {
                  $filestats = stat( $strNewPath );
                  if ( date( "Ymd", $filestats[ 'mtime' ] ) < $time_limit )
                  {
                    $files[ ] = $strNewPath;
                  }
                }
              }

              if( is_dir( $strNewPath ) )
              {
                $files = fnListFiles( $strNewPath, $files );
              }
            }
          }
          closedir( $handle );
        }
        RETURN $files;
    }

    echo "\n - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
    echo " Script created by David V. Wallin ( david@dwall.in ) \n\n";
    echo " License : WTFPL ( http://sam.zoy.org/wtfpl/COPYING ) \n\n";
    echo " - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";

    if ( !is_dir( $directory ) )
    {
        echo "# ERROR \n";
        echo "# Cannot find the directory $directory.\n";
        echo "# Make sure that it is valid.\n\n";
        exit;
    }
        
    $files_to_delete_array = fnListFiles( $argv[ 1 ], array( ) );

    $total_size = 0;

    foreach ( $files_to_delete_array as $fi )
    {
        $filestats = stat( $fi );
        $total_size = $total_size + $filestats[ 'size' ];
    }


    echo "\nFiles to delete: ".count( $files_to_delete_array )."\n";
    echo "Total amount of space to be freed up: ". bytes_to_eng( $total_size )."\n\n";
    if ( count( $files_to_delete_array ) == 0 )
    {
        echo "0 files in $directory that were created before " . date( "Y-m-d", $timespan ) . "\n";
        echo "Aborting..\n\n";
        exit;
    }
    echo "If you want to remove the ".count( $files_to_delete_array )." that were created before " . date( "Y-m-d", $timespan ) . " please type 'yes'.\n";
    echo "Continue? : ";
    $sec_handle = fopen( "php://stdin", "r" );
    $line = fgets( $sec_handle );
    if ( trim( $line ) == 'yes' )
    {
        echo "Removing files...";
        $counter = 0;
        foreach ( $files_to_delete_array as $file )
        {
            if ( !unlink( $file ) )
            {
                die( 'Could not delete ' . $file . '\n' );
            }
            if ( $counter == 50 )
            {
               echo ".";
               $counter = 0;
            }
            $counter++;
        }
        echo "\n\n" . count( $files_to_delete_array ) . " files deleted\n\n";
        exit;
    }else
    {
        echo "\n\nYou did not type 'yes'. Aborting!\n\n";
    }

   function bytes_to_eng( $filesize )
   {
      if ( $filesize < 1048676 )
         RETURN number_format( $filesize/1024,1 ) . " KB";
      if ( $filesize>=1048576 && $filesize < 1073741824 )
         RETURN number_format( $filesize/1048576,1 ) . " MB";
      if ( $filesize>=1073741824 && $filesize < 1099511627776 )
         RETURN number_format( $filesize/1073741824,2 ) . " GB";
      if ( $filesize>=1099511627776 )
         RETURN number_format( $filesize/1099511627776,2 ) . " TB";
      if ( $filesize>=1125899906842624 ) //Currently, PB won't show due to PHP limitations
         RETURN number_format( $filesize/1125899906842624,3 ) . " PB";
   }


