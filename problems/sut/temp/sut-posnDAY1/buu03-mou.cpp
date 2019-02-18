/*
TASK: MOUNTAIN
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>

int main()
{
	short mountain[20][100];
	short a,b,c,S,H,N,len,sx,maxy=-1000,maxx=-1000,temp;

	for(a=0;a<20;a++)
		for(b=0;b<100;b++)
			mountain[a][b]=0;

	scanf("%hd",&N);

	for(a=0;a<N;a++)
	{
		scanf("%hd %hd",&S,&H);

		if(maxy<H)
			maxy=H;

		len=(H*2);
		temp=S+len-1;
		if(maxx<temp)
			maxx=temp;

		for(b=1;b<=H;b++)
		{
			len=(H-b)*2;
			sx=S+(b-1);
			mountain[b][sx]+=1;
			sx++;
			for(c=0;c<len;c++)
			{
				mountain[b][sx]+=100;
				sx++;
			}
			mountain[b][sx]+=10;
		}
	}

	for(a=maxy;a>=1;a--)
	{
		for(b=1;b<=maxx;b++)
		{
			if(mountain[a][b]==0)
				printf(".");
			else if(mountain[a][b]==11)
				printf("v");
			else if(mountain[a][b]==1)
				printf("/");
			else if(mountain[a][b]==10)
				printf("\\");
			else
				printf("X");
		}
		printf("\n");
	}

	return 0;
}