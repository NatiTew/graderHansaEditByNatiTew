/*
TASK: SCHOOL
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

char tmp[70][70];

void find(int r,int c);

int main(){
 int wid,hig,i,j,k,l,ans[2],a,b,fl,q,r,g=0,min;
 char dat[70][70];
  scanf("%d %d",&wid,&hig);
  if(wid < hig)
    min = wid;
  else min = hig;
  for(i=0;i<hig;i++){
    scanf("%s",dat[i]);
  }
  ans[0] = 0;
  ans[1] = 0;
  for(i=0;i<hig;i++){
    for(j=0;j<wid;j++){
	  g = 0;
	  for(k=1;k<=(min);k++){
		fl = 0;
		for(a=i;a<i+k;a++){
		  for(b=j;b<j+k;b++){
			if(dat[a][b] == 'T'){
			  fl = 1;
		      break;
			}
	      }
		  if(fl == 1)
			  break;
		}
		if((fl == 0) && ((k*k) >= ans[0]) && (j+k <= wid)){
		  q = (k*k);
		  //printf("q= %d\n",q);
		  //printf("%d %d\n",i,j);
		  for(a=i;a<i+k;a++){
		    strncpy(tmp[a-i],&dat[a][j],k);
			tmp[a-i][k]='\0';
		  }
		  l = 0;
		  for(a=0;a<k;a++){
		    for(b=0;b<k;b++){
			  if(tmp[a][b] == 'P'){
				//printf("Find P [%d %d] %d [%d %d]\n",a,b,ans[0],i,j);
				l++;
			    find(a,b);
			  }			
			}
		  }
		  r = l;
		  //printf("l = %d\n",l);
		  if((q > ans[0])){
		    ans[0] = q;
			if(g == 0){
			  ans[1] = r;
			  g = 1;
			}else if(ans[1] < r)
			  ans[1] = r;
		  }

		}	  
	  }
	
	}
  
  }

  printf("%d %d\n",ans[0],ans[1]);






 return 0;
}

void find(int r,int c){
  tmp[r][c] = 'S';
  if(tmp[r+1][c] == 'P'){
    find(r+1,c);
  }
  if(tmp[r-1][c] == 'P'){
    find(r-1,c);
  }
  if(tmp[r][c+1] == 'P'){
    find(r,c+1);
  }
  if(tmp[r][c-1] == 'P'){
    find(r,c-1);
  }
}
