/*
TASK: MOUNTAIN
LANG: C
AUTHOR: Pundrik Noppun
CENTER: Burapa
*/

#include <stdio.h>

int main()
{
	int n;
	int s,h;
	int i,j;
	scanf("%d",&n);
	if(n==1)
	{
		scanf("%d %d",&s,&h);
		for(i=0;i<h;i++)
		{
			for(j=1;j<2*h+s;j++)
			{
				if(j==s+h-1-i)
					printf("/");
				else if(j==s+h+i)
					printf("\\");
				else if(j>s+h-1-i && j<s+h+i)
					printf("X");
				else
					printf(".");
			}
		printf("\n");
		}
		

	}
	
	return 0;
}
