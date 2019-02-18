/*
TASK: TEMP
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>

int max,n,dat[25][25];

void temper(int r,int c);

int main(){
 int r,c,i,j;
  scanf("%d",&n);
  scanf("%d %d",&c,&r);
  r--;
  c--;
  for(i=0;i<n;i++){
    for(j=0;j<n;j++){
	  scanf("%d",&dat[i][j]);
	}
  }
  max = -10;
  temper(r,c);
  printf("%d\n",max);




 return 0;
}

void temper(int r,int c){
 if(dat[r][c] > max){
   max = dat[r][c];
 }
 if(r+1 < n){
   if((dat[r+1][c] > max) && (dat[r+1][c] != 100)){
     temper(r+1,c);
   }
 }
 if(c+1 < n){
   if((dat[r][c+1] > max) && (dat[r][c+1] != 100)){
     temper(r,c+1);
   }
 }
 if(r-1 >= 0){
   if((dat[r-1][c] > max) && (dat[r-1][c] != 100)){
     temper(r-1,c);
   }
 }
 if(c-1 >= 0){
   if((dat[r][c-1] > max) && (dat[r][c-1] != 100)){
     temper(r,c-1);
   }
 }
 


}
