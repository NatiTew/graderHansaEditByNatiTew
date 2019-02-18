/*
   Add number
*/
#include <stdio.h>

int   main ( void ) {
	int number;
	int count = 0;
	int sum = 0;

	printf ("\nEnter an integer : ");
	scanf ("%d", &number);
	printf ("Your number is : %d \n\n",number);
	
	while (number != 0) {
		printf ("sum = %d \n",sum);
		printf ("number = %d \n",number);
		count++;
		sum += number % 10;
		number /= 10;
	}
	printf ("The number of digits is : %3d\n",count);
	printf ("The sum of the digits is : %3d\n",sum);
	return(0);
}

