/*
 Print star :

       *
       **
       ***
       ****
       *****
*/
#include <stdio.h>

int   main ( void )
{
        int     n = 5;
	int     row , col;

        for ( row = 1; row <= n; ++row ) {         

                for ( col = 1; col <= row; ++col ) {       
                        printf ("*");
                }

		printf ("\n");
        }

        return 0;
}



