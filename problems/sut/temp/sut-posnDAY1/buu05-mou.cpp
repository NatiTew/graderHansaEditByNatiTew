/*
TASK: MOUNTAIN
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: ACS
*/

#include <stdio.h>

int main(){
	char mo[15][200]={0};
	int n,s[25]={0},h[25]={0},i,j,k,p,maxh=0,st,maxl=0;
	scanf(" %d ",&n);
	for(i=0;i<n;i++){
		scanf(" %d %d ",&s[i],&h[i]);
		if(h[i]>maxh)
			maxh=h[i];
		if((s[i]+(2*h[i]))-1>maxl)
			maxl=s[i]+(2*h[i])-1;
	}
	for(i=0;i<n;i++){
		st=s[i]-1;
		for(j=0;j<h[i];j++,st++){
			p=maxh-1;
			for(k=1;k<=j;k++,p--){
				mo[p][st]='X';
			}
			if(mo[p][st]=='\\')
				mo[p][st]='v';
			else if(mo[p][st]=='X')
				continue;
			else
				mo[p][st]='/';
		}
		for(j=h[i]-1;j>=0;j--,st++){
			p=maxh-1;
			for(k=1;k<=j;k++,p--){
				mo[p][st]='X';
			}
			if(mo[p][st]=='/')
				mo[p][st]='v';
			else if(mo[p][st]=='X')
				continue;
			else
				mo[p][st]='\\';
		}
	}
	for(i=0;i<maxh;i++){
		for(j=0;j<maxl;j++){
			if(mo[i][j]!='\\'&&mo[i][j]!='/'&&mo[i][j]!='X'&&mo[i][j]!='v')
                printf(".");
			else
				printf("%c",mo[i][j]);
		}
		printf("\n");
	}
	return 0;
}