#include <stdio.h>
#include <stdlib.h>
#include <string.h>

typedef struct
{
	char    ID[8];
	char    Name[40];
	char    Surname[40];
	char    Class;
	float   Score;
	char    Grade[2];
} STD;

STD  students[2000];

int   main ( void )
{
	FILE   * input , * output;
	char	Line[4096];
	int	i=0;
	
	if ((input=fopen("2.sol","r"))==(FILE *)NULL)
	{
		printf ("Can't opened file \n");
		exit (0);
	}
	
	while (!feof (input))
	{
		fread (&students[i],sizeof(STD),1,input);
		printf ("%s %s %s %d %.1f %s\n",students[i].ID,students[i].Name,students[i].Surname,students[i].Class,students[i].Score,students[i].Grade);
		i++;
	}
	
	fclose (input);	
	
	return (0);
	
	
}
