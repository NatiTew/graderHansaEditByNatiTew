/*
TASK: SMS
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(){
 char dat[3][3][5],str[100];
 int i,n,m,cou,num,r,c,h,v,len,ind;
  dat[0][0][0] = '\0';
  strcpy(dat[0][1],"ABC");
  strcpy(dat[0][2],"DEF");
  strcpy(dat[1][0],"GHI");
  strcpy(dat[1][1],"JKL");
  strcpy(dat[1][2],"MNO");
  strcpy(dat[2][0],"PQRS");
  strcpy(dat[2][1],"TUV");
  strcpy(dat[2][2],"WXYZ");
  str[0] = '\0';
  scanf("%d",&n);
  scanf("%d %d",&num,&cou);
  switch(num){
    case 1 : r=0;c=0;break;
	case 2 : r=0;c=1;break;
	case 3 : r=0;c=2;break;
	case 4 : r=1;c=0;break;
	case 5 : r=1;c=1;break;
	case 6 : r=1;c=2;break;
	case 7 : r=2;c=0;break;
	case 8 : r=2;c=1;break;
	case 9 : r=2;c=2;break;
  }
  len = strlen(dat[r][c]);
  ind = 0;
  if(len > 0){
    str[0] = (dat[r][c][(cou-1)%len]);
	ind++;
  }
  for(m=0;m<(n-1);m++){
    scanf("%d %d %d",&h,&v,&cou);
	r += v;
	c += h;
    len = strlen(dat[r][c]);
    if(len > 0){
      str[ind] = (dat[r][c][(cou-1)%len]);
	  ind++;
    }else{
	  for(i=0;i<cou;i++){
	    if(ind > 0){
	      str[ind-1] = '\0';
	      ind--;
	    }else break;
	  }
	}  
  }
  str[ind] = '\0';
  if(str[0] != '\0')
    printf("%s\n",str);
  else printf("null\n");










 return 0;
}
