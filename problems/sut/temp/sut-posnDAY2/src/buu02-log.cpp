/*
TASK: LOGISTIC
LANG: C
AUTHOR: Napat Hataivichian
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>

typedef struct{
  char a,b;
  int cost;
}Logis;

int compare(const void *a,const void *b);

int main(){
 int i,j,n,fl,f,tmp[300],ind,dex,k,ai=0;
 Logis dat[300];
 char ch,str[300][2],ans[300];
 double sum[300],plus=0;
  scanf("%d",&n);
  for(i=0;i<n;i++){
    scanf(" %c %c %d",&dat[i].a,&dat[i].b,&dat[i].cost);
	if(dat[i].a == 'Y')
	  dat[i].a = '|';
    if(dat[i].b == 'Y')
	  dat[i].b = '|';
	if(dat[i].b < dat[i].a){
	  ch = dat[i].a;
	  dat[i].a = dat[i].b;
	  dat[i].b = ch;
	}
	//printf("%c %c %d\n",dat[i].a,dat[i].b,dat[i].cost);
  }
  fl = 0;
  for(i=0;i<n;i++){
	f = 0;
    for(j=0;j<n;j++){	  
	  if((dat[i].a!=dat[j].a) || (dat[i].b!=dat[j].b)){
		if((dat[i].a==dat[j].a) || (dat[i].a==dat[j].b) || (dat[i].b==dat[j].a) || (dat[i].b==dat[j].b)){
		  f = 1;
		  break;
		}/*else if((dat[i].a!=dat[j].a) && (dat[i].a!=dat[j].b) && (dat[i].b!=dat[j].b) && (dat[i].b!=dat[j].a)){
		  printf("[%c %c] != [%c %c]\n",dat[i].a,dat[i].b,dat[j].a,dat[j].b);
		  fl = 1;
		  break;
		}*/
	  }
	}
    if(f == 0){
	  fl = 1;
	  break;
	}
  }
  if(fl == 1){
    printf("broken\n");
    return 0;
  }
  //printf("pass\n");
  ans[0] = 'X';
  ch = '\0';
  ai = 1;
  for(i=0;i<n;i++){
    if(dat[i].a == 'X'){
	  ch = dat[i].b;
	  ans[1] = ch;
	  ai++;
	  break;
	}
	if(dat[i].b == 'X'){
	  ch = dat[i].a;
	  ans[1] = ch;
	  ai++;
	  break;
	}
  }
  while(ch != '\0'){
    for(i=0;i<n;i++){
	  if(dat[i].a == ch){
		fl = 0;
		for(j=0;j<ai;j++){
		  if(dat[i].b == ans[j]){
		    fl = 1;
			break;
		  }
		}
        if(fl == 0){
	      ch = dat[i].b;
	      ans[ai] = ch;
		  if(ch == '|'){
		    ch = '\0';
		    //ans[ai] = 'Y';
		  }
		  ai++;
	      break;
		}
	  }

	  if(dat[i].b == ch){
		fl = 0;
		for(j=0;j<ai;j++){
		  if(dat[i].a == ans[j]){
		    fl = 1;
			break;
		  }
		}
        if(fl == 0){
	      ch = dat[i].a;
	      ans[ai] = ch;
		  if(ch == '|'){
		    ch = '\0';
		    //ans[ai] = 'Y';
		  }
		  ai++;
	      break;
		}
	  }
	
	}
  }
  
  /*for(i=0;i<ai;i++)
    printf("%c ",ans[i]);
  printf("\n\n");*/
  dex = 0;
  for(i=0;i<n;i++){
	tmp[0] = dat[i].cost;
	ind = 1;
	fl = 0;
    for(k=0;k<dex;k++){
	  if((dat[i].a==str[k][0]) && (dat[i].b==str[k][1])){
		fl = 1;
	    break;
	  }
	}
	if(fl == 0){
    for(j=0;j<n;j++){
	  if(i != j){
	      if((dat[i].a==dat[j].a) && (dat[i].b==dat[j].b)){
		    tmp[ind] = dat[j].cost;
		    ind++;
			str[dex][0] = dat[j].a;
			str[dex][1] = dat[j].b;
		  }
	  }	
	}
      qsort(tmp,ind,sizeof(int),compare);
	  /*for(j=0;j<ind;j++)
        printf("%d ",tmp[j]);
	  printf("\nind = %d\n",ind);*/
	  if(ind%2 == 1){
	    sum[dex] = (double)tmp[((ind+1)/2)-1];
	  }else{
	    sum[dex] = (double)(tmp[ind/2]+tmp[(ind-1)/2])/2.0;
	  }
	  str[dex][0] = dat[i].a;
	  str[dex][1] = dat[i].b;
	  //printf("%c ",str[dex][0]);
	  if(str[dex][1] == '|'){
	    //printf("Y ");
	    //str[dex][1] = 'Y';
	  }
	  //else printf("%c ",str[dex][1]);
	  //printf("%.1lf\n",sum[dex]);
	  plus += sum[dex];
	  dex++;
    }  
  }
  //printf("%.1lf\n\n",plus);

  for(i=0;i<ai-1;i++){
	if(ans[i+1] == '|')
	  printf("%c Y ",ans[i]);
    else printf("%c %c ",ans[i],ans[i+1]);
    for(j=0;j<dex;j++){
	  if(((str[j][0]==ans[i]) && (str[j][1]==ans[i+1])) || ((str[j][1]==ans[i]) && (str[j][0]==ans[i+1]))){
	    printf("%.1lf\n",sum[j]);
		break;
	  }
	}
  }
  printf("%.1lf\n",plus);











 return 0;
}

int compare(const void *a,const void *b){
  return ( (*(int *)a) - (*(int *)b) );
}
