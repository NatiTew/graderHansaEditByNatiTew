/*
TASK: TEMP
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>

short max=-1000;
short mountain[25][25];

void search(short y,short x,short value)
{
	short a,b,check=0,temp;

	a=y-1;
	b=x;
	temp=mountain[a][b];
	if(temp>value && temp!=100)
	{
		search(a,b,temp);
		check++;
	}

	a=y;
	b=x+1;
	temp=mountain[a][b];
	if(temp>value && temp!=100)
	{
		search(a,b,temp);
		check++;
	}

	a=y+1;
	b=x;
	temp=mountain[a][b];
	if(temp>value && temp!=100)
	{
		search(a,b,temp);
		check++;
	}

	a=y;
	b=x-1;
	temp=mountain[a][b];
	if(temp>value && temp!=100)
	{
		search(a,b,temp);
		check++;
	}

	if(check==0)
		if(max<value)
			max=value;
}

int main()
{
	short a,b,size,startx,starty;

	scanf("%hd %hd %hd",&size,&startx,&starty);

	for(a=0;a<25;a++)
		for(b=0;b<25;b++)
			mountain[a][b]=100;

	for(a=1;a<=size;a++)
		for(b=1;b<=size;b++)
			scanf("%hd",&mountain[a][b]);

	search(starty,startx,mountain[starty][startx]);

	printf("%hd\n",max);

	return 0;
}