<?php
// set the default timezone to use. Available since PHP 5.1
// date_default_timezone_set('UTC');


// Prints something like: Monday
// echo date("l");
// echo "\n";
// Prints something like: Monday 8th of August 2005 03:12:46 PM
// echo date('l jS \of F Y h:i:s A');

// Prints: July 1, 2000 is on a Saturday
// echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));

/* use the constants in the format parameter */
// prints something like: Mon, 15 Aug 2005 15:12:46 UTC
// echo date(DATE_RFC822);

// prints something like: 2000-07-01T00:00:00+00:00
// echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
echo date("m");
echo " ";
echo date("d");
echo " ";
echo date("Y");
echo " ";
echo date("g");
echo " ";
echo date("i");
?>
