/*
 *
    Print star2 :
         *****
         ****
         ***
         **
         *
*/
 
#include  <stdio.h> 

int   main ( void )
{
     int   n = 5;
     int   row , col;

     for (row = 0; row < n; ++row) {
          for (col = 1; col <= (n - row); ++col) {
		printf ("*");
          }
	  printf ("\n");
     }
      return 0;
}


