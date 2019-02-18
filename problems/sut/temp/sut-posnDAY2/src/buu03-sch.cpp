/*
TASK: SCHOOL
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>

short width,height,max=-1000,minpool=10000,pool;
long school[70][70],test[70][70];
char input[70][70];

short min(short a,short b)
{
	if(a<b)
		return a;
	return b;
}

void search(short y,short x)
{
	short a,b;

	a=y;
	b=x-1;
	if(test[a][b]=='P')
	{
		test[a][b]='S';
		search(a,b);
	}

	a=y-1;
	b=x;
	if(test[a][b]=='P')
	{
		test[a][b]='S';
		search(a,b);
	}

	a=y+1;
	b=x;
	if(test[a][b]=='P')
	{
		test[a][b]='S';
		search(a,b);
	}

	a=y;
	b=x+1;
	if(test[a][b]=='P')
	{
		test[a][b]='S';
		search(a,b);
	}
}

int main()
{
	short a,b,c,d,e,area,temp;

	scanf("%hd %hd",&width,&height);

	for(a=0;a<=height+1;a++)
		for(b=0;b<=width+1;b++)
			school[a][b]=0;

	for(a=1;a<=height;a++)
		scanf("%s",&input[a][1]);

	for(a=1;a<=height;a++)
		for(b=1;b<=width;b++)
		{
			if(input[a][b]=='T')
				temp=10000;
			else
				temp=1;
			school[a][b]=temp+school[a-1][b]+school[a][b-1]-school[a-1][b-1];
		}

	for(a=height;a>=1;a--)
		for(b=width;b>=1;b--)
			for(c=min(a,b);c>=1;c--)
			{
				area=school[a][b]-school[a-c][b]-school[a][b-c]+school[a-c][b-c];
				if(area>max && area<10000)
				{
					max=area;
					minpool=0;
					for(d=a-c+1;d<=a;d++)
						for(e=b-c+1;e<=b;e++)
							test[d][e]=input[d][e];
					for(d=a-c+1;d<=a;d++)
						for(e=b-c+1;e<=b;e++)
							if(test[d][e]=='P')
							{
								test[d][e]='S';
								search(d,e);
								minpool++;
							}
				}
				else if(area==max)
				{
					pool=0;
					for(d=a-c+1;d<=a;d++)
						for(e=b-c+1;e<=b;e++)
							test[d][e]=input[d][e];
					for(d=a-c+1;d<=a;d++)
						for(e=b-c+1;e<=b;e++)
							if(test[d][e]=='P')
							{
								test[d][e]='S';
								search(d,e);
								pool++;
							}
					if(pool<minpool)
						minpool=pool;
				}
			}
	
	if(max==-1000)
		printf("0 0\n");
	else
		printf("%hd %hd\n",max,minpool);

	return 0;
}