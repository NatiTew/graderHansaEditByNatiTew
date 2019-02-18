/*
TASK: KEY
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <math.h>

char find(char a,char b,char c);

int main(){
 int i,j,n,lm,lc,r,len;
 char str[3][150],tmp[150],ch,a[150];
  scanf("%d %d",&lm,&lc);
  scanf("%s %s %s",str[0],str[2],str[1]);
  if(lc > lm){
    for(i=lm;i<=lc;i++){
	  str[0][i] = '@';
	  str[2][i] = '[';
	}
	str[0][lc+1] = '\0';
	str[2][lc+1] = '\0';
	lm = lc+1;
  }
  tmp[0] = str[1][lc-1];
  tmp[1] = '\0';
  for(i=0;i<lc-1;i++){
    len = strlen(tmp);
	for(j=0;j<len;j++){
	  ch = find(str[0][j],tmp[j],str[2][j]);
	  //printf("ch = %c [%c %c %c]\n",ch,str[0][j],tmp[j],str[2][j]);
	  tmp[j] = ch;
	}
	
	strcpy(a,tmp);
	strcpy(&tmp[1],a);
	tmp[0] = str[1][lc-(i+2)];
	//printf("%s\n",tmp);  
  }
  //printf("\ntmp = %s\n\n",tmp);
  for(i=0;i<=(abs(lm-lc));i++){
    for(j=0;j<lc;j++){
	  ch = find(str[0][i+j],tmp[j],str[2][i+j]);
	  tmp[j] = ch;
	}
	//printf("%s\n",tmp);
  }
  //printf("\ntmp = %s\n",tmp);
  for(i=0;i<(lc);i++){
    for(j=0;j<(lc-i);j++){
	  ch = find(str[0][abs(lm-lc)+i+j],tmp[j],str[2][abs(lm-lc)+i+j]);
	  //printf("ch = %c [%c %c %c]\n",ch,str[0][abs(lm-lc)+i+j],tmp[j],str[2][abs(lm-lc)+i+j]);
	  tmp[j] = ch;
	}
	//printf("tmp = %s\n",tmp);
  
  }
  printf("%s\n",tmp);









 return 0;
}

char find(char a,char b,char c){
  char min=127,max=64;
  if(a <= min)
    min = a;
  if(b <= min)
    min = b;
  if(c <= min)
	min = c;
  if(a >= max)
	max = a;
  if(b >= max)
	max = b;
  if(c >= max)
	max = c;
  if((a==min) && (c==max))
    return b;
  if((c==min) && (a==max))
    return b;
  if((b==min) && (c==max))
    return a;
  if((c==min) && (b==max))
    return a;
  if((a==min) && (b==max))
    return c;
  if((b==min) && (a==max))
    return c;
}
