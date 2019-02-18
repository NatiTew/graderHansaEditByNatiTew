/*
TASK: KEY
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>

int L,K;
char mom[2][150];
char key[150];
char temp[3];

int sort_f(const void *a,const void *b){
	if(*(char*)a<*(char*)b) return -1;
	else if(*(char*)a>*(char*)b) return 1;
	return 0;
}

int main(){
	int i,j,k;
	scanf("%d %d",&L,&K);
	scanf("%s",mom[0]);
	scanf("%s",mom[1]);
	scanf("%s",key);
	for(i=0;i<L;i++){
		for(j=K-1,k=i;j>-1 && k>-1 ;j--,k--){
			temp[0]=mom[0][k];
			temp[1]=key[j];
			temp[2]=mom[1][k];
			if(temp[0] <= temp[1] && temp[1]<=temp[2]) continue;
			else if(temp[0] <= temp[1] && temp[1]<=temp[2]) continue;
			else{
				qsort((void*)temp,3,sizeof(char),sort_f);
				key[j]=temp[1];
			}
		}
	}
	
	for(i=K-1;i>-1;i--){
		for(j=i,k=L-1;j>-1 && k>-1;j--,k--){
			temp[0]=mom[0][k];
			temp[1]=key[j];
			temp[2]=mom[1][k];
			if(temp[0] <= temp[1] && temp[1]<=temp[2]) continue;
			else if(temp[0] <= temp[1] && temp[1]<=temp[2]) continue;
			else{
				qsort((void*)temp,3,sizeof(char),sort_f);
				key[j]=temp[1];
			}
		}
	}
	printf("%s\n",key);
	return 0;
}
