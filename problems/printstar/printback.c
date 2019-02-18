/*
    Print number backward
*/
#include <stdio.h>

int main ( void ) {

	long num;
	int  digit;

	printf ("Enter a number and I'll print it backward : ");
	scanf ("%ld", &num);

	while (num > 0 ) {
		digit = num % 10;
		printf ("%d", digit);
		num = num/10;
	}
	return(0);
}


