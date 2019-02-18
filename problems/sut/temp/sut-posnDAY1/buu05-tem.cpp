/*
TASK: TEMP
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: ACS
*/

#include <stdio.h>

int play(int x,int y,int a[][30],int max,int n){
	if(a[x][y]>max){
		max=a[x][y];
	}
	if(a[x+1][y]>a[x][y]&&a[x+1][y]!=100&&x+1<=n&&x>0&&y<=n&&y>0)
		max=play(x+1,y,a,max,n);
	if(a[x][y+1]>a[x][y]&&a[x][y+1]!=100&&y+1<=n&&x>0&&x<=n&&y>0)
		max=play(x,y+1,a,max,n);
	if(a[x-1][y]>a[x][y]&&a[x-1][y]!=100&&x-1>0&&x<=n&&y<=n&&y>0)
		max=play(x-1,y,a,max,n);
	if(a[x][y-1]>a[x][y]&&a[x][y-1]!=100&&y-1>0&&x<=n&&y<=n&&x>0)
		max=play(x,y-1,a,max,n);
	return max;
}
int main(){
	int n,x,y,i,j,a[30][30]={0},max;
	scanf("%d",&n);
	scanf("%d %d",&y,&x);
	for(i=1;i<=n;i++){
		for(j=1;j<=n;j++){
			scanf("%d",&a[i][j]);
		}
	}
	max=play(x,y,a,-5,n);
	printf("%d\n",max);
	return 0;
}