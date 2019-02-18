/* 
   Print star :

                *
              **
            ***
          ****
        *****
*/
#include   <stdio.h>

int   main (  )
{
     int         n = 5;
     int         row , col , sp;

     for (row = 1; row <= n; ++row ) {
        for (sp = 1; sp <= (n - row); ++sp ) {
		printf ("  ");
        }
        for (col = 1; col <= row; ++col ) {
		printf ("*");
        }
	printf ("\n");
      }
      return 0;
}


