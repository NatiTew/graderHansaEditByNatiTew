/*
TASK: TEMP
LANG: C
AUTHOR: Pundrik Noppun
CENTER: Burapa
*/

#include <stdio.h>

int m;
int  arr[21][21]={{0}};
int max=0;
void fun(int i,int j)
{
	
	if(arr[i-1][j] > arr[i][j] &&  arr[i-1][j] !=100  && i-1>=0 )
		fun(i-1,j);
	if(arr[i+1][j]>arr[i][j] && arr[i+1][j] !=100 && i+1 <m)
		fun(i+1,j);
	if(arr[i][j+1]>arr[i][j] && arr[i][j+1] !=100 && j+1 < m)
		fun(i,j+1);
	if(arr[i][j-1]>arr[i][j] && arr[i][j-1] !=100 && j-1>=0)
		fun(i,j-1);
	if(arr[i][j]>max)
		max=arr[i][j];

	
}

int main()
{

	
	int jb,ib;
	int i,j;
	scanf("%d",&m);
	scanf("%d %d",&jb,&ib);
	jb--; ib--;
	
	for(i=0;i<m;i++)
	{
		for(j=0;j<m;j++)
		{
		scanf("%d",&arr[i][j]);
		}
	}

	
	fun(ib,jb);
	printf("%d",max);


	
	return 0;
}
