/*
TASK: TEMP
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/
 
#include <stdio.h>

int R[25][25];
int m,max;

void walk(int r,int c){
	if(max<R[r][c]) max=R[r][c];
	if(-5<=R[r][c-1] && R[r][c-1]<=37 && 1<=c-1 && R[r][c]<R[r][c-1]) walk(r,c-1);
	if(-5<=R[r-1][c] && R[r-1][c]<=37 && 1<=r-1 && R[r][c]<R[r-1][c]) walk(r-1,c);
	if(-5<=R[r][c+1] && R[r][c+1]<=37 && c+1<=m && R[r][c]<R[r][c+1]) walk(r,c+1);
	if(-5<=R[r+1][c] && R[r+1][c]<=37 && r+1<=m && R[r][c]<R[r+1][c]) walk(r+1,c);
}

int main(){
	int x,y,i,j;
	scanf("%d",&m);
	scanf("%d %d",&x,&y);
	for(i=1;i<=m;i++)
		for(j=1;j<=m;j++)
			scanf("%d",&R[i][j]);
	max=R[y][x];
	walk(y,x);
	printf("%d\n",max);
	return 0;
}
