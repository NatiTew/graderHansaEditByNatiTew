/*
TASK: LOGISTICS
LANG: C
AUTHOR: PUNDRIK NOPPUN
CENTER: BUU
*/

#include <stdio.h>


typedef struct 
{
	char a,b;
	int index;
	int arr[11];
	int pairs;
	float median;

}bus;
bus arr[30];
char check[1000]={0};
int ind=0;

float sum=0;
int count=0;
int ct=0;
int find(char c)
{
	int i,j;
	int cha=0,chb=0;
	int temp;
	
	for(i=0;i<count;i++)
	{
		/*for(j=0;j<ind;j++)
			{
			  if(arr[i].a==check[j])
				  cha++;
			  if(arr[i].b==check[j])
				  chb++;
			} */
		if(arr[i].a==c)
			{
			printf("%c %c %.1f\n",arr[i].a,arr[i].b,arr[i].median);
			arr[i].a='0';
			temp=arr[i].b;
			arr[i].b='0';

			find(temp);
			}
		else if(arr[i].b==c)
		    {
			printf("%c %c %.1f\n",arr[i].b,arr[i].a,arr[i].median);
			arr[i].b='0';
			temp=arr[i].a;
			arr[i].a='0';
			find(temp);
			}
		
			
			
	}
}

float sort(int arr[],int len)
{
	int i,j;
	int tmp;
	float ans;

	for(j=0;j<len;j++)
	{
		for(i=j;i<len;i++)
		{
			if(arr[i]<arr[j])
			{
			tmp=arr[i];
			arr[i]=arr[j];
			arr[j]=tmp;

		}
		}
	}

	/*for(i=0;i<len ;i++)
		printf("%d ",arr[i]);
	*/

	if(len%2==0)
		{
		sum+=( (float)(arr[len/2] + arr[(len/2)-1]) ) / 2.0 ;
		//printf(": %.1f\n", ( (float)(arr[len/2] + arr[(len/2)-1]) ) / 2.0);
		return ( (float)(arr[len/2] + arr[(len/2)-1]) ) / 2.0 ;
		
		}
	else
		sum+=(float)(arr[len/2]);
		//printf(": %.1f\n",(float)(arr[len/2]));
		return (float)(arr[len/2]);
	//return arr[1];
	
}


int main()
{
	
	
	int n,ch;
	char a,b;
	int i,j,num;
	
	scanf("%d",&n);
	getchar();
	for(i=0;i<30;i++)
		arr[i].index=0;
	for(i=0;i<n;i++)
	{
		if(i==0)
		{
			scanf("%c %c %d",&a,&b,&num);
			getchar();
			//printf("%c %c %d\n",a,b,num);
			arr[i].a=a;
			arr[i].b=b;
			arr[i].arr[arr[i].index]=num;
			arr[i].pairs=a+b;
			arr[i].index++;
			count++;
		}
		else
		{
			scanf("%c %c %d",&a,&b,&num);
			getchar();
			//printf("%c %c %d\n",a,b,num);
			ch=0;
			for(j=0;j<count;j++)
			{
				if(arr[j].pairs==a+b)
				{
					ch++;
					arr[j].arr[arr[j].index]=num;
					arr[j].index++;
				}
			}

			if(ch==0)
			{	
			arr[count].a=a;
			arr[count].b=b;
			arr[count].arr[arr[count].index]=num;
			arr[count].pairs=a+b;
			arr[count].index++;
			count++;

			}

		}
	}

	
	for(i=0;i<count;i++)
		{
		
		arr[i].median=sort(arr[i].arr,arr[i].index);
		
		
		}
	find('X');
	printf("%.1f",sum);
	
	
	return 0;
}
