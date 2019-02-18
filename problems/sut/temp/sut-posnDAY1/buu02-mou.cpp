/*
TASK: MOUNTAIN
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

typedef struct{
 int s,h,l;
}mountain;

int main(){
 int n,i,j,maxr=0,maxc=0,m,st,lt,nx;
 mountain dat[25];
 char cro[15][220];
  scanf("%d",&n);
  for(i=0;i<n;i++){
    scanf("%d %d",&dat[i].s,&dat[i].h);
	dat[i].s--;
	dat[i].l = dat[i].s + ((dat[i].h*2)-1);
    if(dat[i].h > maxr)
	  maxr = dat[i].h;
	if(dat[i].l > maxc)
	  maxc = dat[i].l;
  }
  maxc++;
  for(i=0;i<maxr;i++){
    for(j=0;j<maxc;j++){
	  cro[i][j] = '.';
	}
  }
  for(m=0;m<n;m++){
    st = dat[m].s;
	lt = dat[m].l;
	nx = (dat[m].h*2)-2;
	for(i=1;i<=dat[m].h;i++){
	  if(cro[maxr-i][st] == '.')
	    cro[maxr-i][st] = '/';
	  else if((cro[maxr-i][st] == '\\')){
	    cro[maxr-i][st] = 'v';
	  }
	  for(j=1;j<=nx;j++){
	    cro[maxr-i][st+j] = 'X';
	  }
	  if(cro[maxr-i][lt] == '.')
	    cro[maxr-i][lt] = '\\';
	  else if((cro[maxr-i][lt] == '/')){
	    cro[maxr-i][lt] = 'v';
	  }
	  st++;
	  lt--;
	  nx -= 2;	
	}
	/*for(i=0;i<maxr;i++){
      for(j=0;j<maxc;j++){
	    printf("%c",cro[i][j]);
	  }
	  printf("\n");
    }
	printf("\n\n");*/
  }


  for(i=0;i<maxr;i++){
    for(j=0;j<maxc;j++){
	  printf("%c",cro[i][j]);
	}
	printf("\n");
  }








 return 0;
}
