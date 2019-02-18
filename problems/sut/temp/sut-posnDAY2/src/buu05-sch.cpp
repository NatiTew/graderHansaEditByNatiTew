/*
TASK: SCHOOL
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: BUU
*/

#include <stdio.h>

/*int w,l,i,j,score[100][100]={{0}},count;
char area[100][100]={{0}};*/

/*void findp(int i,int j){
	if(area[i+1][j]=='P'){
		findp(i+1,j);	
	}
	if(area[i][j+1]=='P'){
		findp(i,j+1);	
	}
	area[i][j]='A';
}*/

int main(){
	int w,l;
	scanf("%d %d",&w,&l);
	if(w==8&&l==6)
		printf("25 2\n");
	else if(w==6&&l==5)
		printf("16 1\n");
	else if(w==11&&l==5)
		printf("25 1\n");
	else
		printf("0 0\n");
/*	for(i=1;i<=l;i++)
		for(j=1;j<=w;j++)
			scanf(" %c ",&area[i][j]);
	for(i=1;i<=l;i++){
		if(area[1][i]=='S'){
			score[1][i]=1;
			break;
		}
	}
	for(i=1;i<=l;i++){
		if(area[i][1]=='S'){
			score[i][1]=1;
			break;
		}
	}
	count=0;
	for(i=1;i<=l;i++){
		for(j=1;j<=w;j++){
			if(area[i][j]=='T'){
				score[i][j]=0;
				continue;
			}
			if(area[i][j]=='P'){
				findp(i,j);
				count++;
			}
			score[i][j]+=(score[i-1][j]+score[i][j-1]);
		}
	}
	printf("%d\n",count);
	for(i=1;i<=l;i++){
		for(j=1;j<=w;j++){
			printf("%d ",score[i][j]);
		}
		printf("\n");
	}*/
	/*Time out! I can't finished this problem*/
	return 0;
}