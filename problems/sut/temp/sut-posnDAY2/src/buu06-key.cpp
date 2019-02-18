/*
TASK: KEY
LANG: C
AUTHOR: PUNDRIK NOPPUN
CENTER: BUU
*/


#include <stdio.h>
#include <string.h>



typedef struct 
{
	char c;
	


}keys;



char sort2(char arr[])
{
	int i,j;
	char tmp;

	for(j=0;j<3;j++)
	{
		for(i=j;i<3;i++)
		{
			if(arr[i]<arr[j])
			{
			tmp=arr[i];
			arr[i]=arr[j];
			arr[j]=tmp;

		}
		}
	}

	
	return arr[1];
	
}

int main()
{
	
	keys key[150];
	char arr[4]={0};
	char L1[150]={0};
	char L2[150]={0};
	char c;
	
	int L,K;
	int i,j,count;
	
	scanf("%d %d",&L,&K);
	scanf("%s",L1);
	scanf("%s",L2);
	c=getchar();
	
	for(i=0;i<K;i++)
	{
		key[i].c=getchar();
				
	}

	
	
	
	for(i=0;i<L;i++)
	{
		for(j=0;j<K;j++)
		{
		arr[0]=key[j].c;
		arr[1]=L1[i];
		arr[2]=L2[i];
		
		key[j].c=sort2(arr);
		
	
		

		}
	}

	for(i=0;i<K;i++)
	{
		printf("%c",key[i].c);
	}
	
	
	return 0;
}

