/*
TASK: MOUNTAIN
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/

#include <stdio.h>


int main(){
	int i,a,b,lim;
	char temp[2];
	char ta[100][100];
	int mou[100][2],h,w,n;
	temp[0]='/';
	temp[1]=92;
	scanf("%d",&n);
	h=w=0;
	for(i=0;i<n;i++){
		scanf("%d %d",&mou[i][0],&mou[i][1]);
		if(h<mou[i][1]) h=mou[i][1];
		if(w<((mou[i][0]-1)+(2*mou[i][1]))) w=(mou[i][0]-1)+(2*mou[i][1]);
	}
	for(a=1;a<=h;a++)
		for(b=1;b<=w;b++)
			ta[a][b]='.';
	for(i=0;i<n;i++){
		for(a=h;a>(h-mou[i][1]) && a>0;a--){
			lim=((mou[i][0]-1)+(2*mou[i][1]))-(h-a);
			b=(mou[i][0]+(h-a));
			
			if(ta[a][b]=='.') ta[a][b]=temp[0];
			else if(ta[a][b]==temp[1]) ta[a][b]='v';
			for(b=(mou[i][0]+(h-a))+1;b<lim;b++){
				ta[a][b]='X';
			}
			if(ta[a][lim]=='.') ta[a][lim]=temp[1];
			else if(ta[a][lim]==temp[0]) ta[a][lim]='v';
		}
	}
	for(a=1;a<=h;a++){
		for(b=1;b<=w;b++){
			printf("%c",ta[a][b]);
		}
		printf("\n");
	}
	return 0;
}
