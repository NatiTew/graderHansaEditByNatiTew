/*
TASK: SMS
LANG: C
AUTHOR: Pundrik Noppun
Center: Burapa
*/

#include <stdio.h>
#include <string.h>

int main()
{
	int i=0,j,n,index=0;
	int h,v,time,num,k;
	char ans[20000]={0};
	char arr[10][5]={
		{""},
		{""},
		{"ABC"},
		{"DEF"},
		{"GHI"},
		{"JKL"},
		{"MNO"},
		{"PQRS"},
		{"TUV"},
		{"WXYZ"}
		};
	
	scanf("%d",&num);
	scanf("%d %d",&n,&time);
	if(n!=1)
	{
	i=time%strlen(arr[n]);
	if(i==0)
		i=strlen(arr[n])-1;
	else
		i--;
	ans[index]=arr[n][i];
	index++;

		
		
	}

	for(j=0;j<num-1;j++)
	{
		scanf("%d %d %d",&h,&v,&time);
		n+=h;
		n+=(v*3);
		
		
		if(n!=1)
		{
		
			i=time%strlen(arr[n]);
		
			if(i==0)
				i=strlen(arr[n])-1;
			else
				i--;
			ans[index]=arr[n][i];
		
			index++;
		}

		else
		{
		for(k=0;k<time;k++)
			{
			ans[index]='\0';
			index--;
			}
		}

	}

	
	if(index<=0)
		printf("null");
	else
	{	
		printf("%s",ans);
	}
	return 0;
}
