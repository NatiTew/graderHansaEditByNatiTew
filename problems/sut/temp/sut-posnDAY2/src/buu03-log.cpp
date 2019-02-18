/*
TASK: LOGISTICS
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>
#include<stdlib.h>

struct way
{
	char s1[2],s2[2];
	short cost;
};

struct answer
{
	char from,to;
	double cost;
};

int compare(const void*a,const void*b)
{
	return *(short*)a-*(short*)b;
}

int main()
{
	short a,N,countused=0,countans=0,car,checkY=0;
	short used[300]={0};
	double allcost=0,med;
	struct way way[300];
	struct answer answer[30];
	char cur='X',next;
	short number[20];

	scanf("%hd",&N);

	for(a=0;a<N;a++)
		scanf("%s %s %hd",way[a].s1,way[a].s2,&way[a].cost);

	while(countused!=N)
	{
		for(a=0;a<N;a++)
		{
			if(way[a].s1[0]==cur && used[a]==0)
			{
				next=way[a].s2[0];
				break;
			}
			else if(way[a].s2[0]==cur && used[a]==0)
			{
				next=way[a].s1[0];
				break;
			}
		}
		
		if(a==N)
		{
			printf("broken\n");
			return 0;
		}

		if(next=='Y')
			checkY=1;

		answer[countans].from=cur;
		answer[countans].to=next;
		car=0;
		for(a=0;a<N;a++)
		{
			if(way[a].s1[0]==cur && way[a].s2[0]==next || way[a].s1[0]==next && way[a].s2[0]==cur && used[a]==0)
			{
				number[++car]=way[a].cost;
				used[a]=1;
				countused++;
			}
		}
	
		qsort(number,car,sizeof(number[0]),compare);

		if(car%2==1)
		{
			med=number[(car+1)/2];
			answer[countans++].cost=med;
			allcost+=med;
		}
		else if(car%2==0)
		{
			med=(number[car/2]+number[car/2+1])/2.0;
			answer[countans++].cost=med;
			allcost+=med;
		}
		cur=next;
	}

	if(checkY==0) {
		printf("broken\n"); }
	else
	{
		for(a=0;a<countans;a++)
			printf("%c %c %.1lf\n",answer[a].from,answer[a].to,answer[a].cost);
		printf("%.1lf\n",allcost);
	}

	return 0;
}