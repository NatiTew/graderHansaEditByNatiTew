/*
  Print star :
1********
12*******
123******
1234*****
12345****
123456***
1234567**
12345678*
123456789
*/

#include <stdio.h>

int main ( void ) {
	int  row;
	int  col;
	int  limit;

	printf ("\nPlease enter a number between 1 and 9: ");
	scanf ("%d", &limit);
	
	for (row = 1; row <= limit; row++) {
		for (col = 1; col <= limit; col++) {
			if (row >= col)
				printf ("%d", col);
			else
				printf ("*");
		}
		printf ("\n");
	}
	return(0);
}
