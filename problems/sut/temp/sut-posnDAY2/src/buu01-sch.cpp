/*
TASK: SCHOOL
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/

#include <stdio.h>

char in[80][80];
int R[80][80],m,n;
int w,l,max=-9999,min=9999;
char temp[80][80];

void init(){
	int i,j;
	scanf("%d %d",&w,&l);

	for(i=1;i<=l;i++){
		for(j=1;j<=w;j++){
			scanf(" %c",&in[i][j]);
			if(in[i][j]=='S' || in[i][j]=='P'){
				R[i][j]=1;
			}else R[i][j]=0;
		}
		in[i][0]='-';
		in[i][w+1]='\0';
	}
}

int checksquare(int r1,int c1,int r2,int c2){
	int sum=0;
	sum=R[r2][c2]-R[r2][c1]-R[r1][c2]+R[r1][c1];
	if(sum==((r2-r1)*(c2-c1))){
		return sum;
	}
	return 0;
}

void clear_P(int i,int j){
	temp[i][j]='-';
	if(temp[i-1][j]=='P' && i-1>0) clear_P(i-1,j);
	if(temp[i][j-1]=='P' && j-1>0) clear_P(i,j-1);
	if(temp[i+1][j]=='P' && i+1<=m) clear_P(i+1,j);
	if(temp[i][j+1]=='P' && j+1<=n) clear_P(i,j+1);
}

int main(){
	int i,j,a,b,c,d,p,q,sum,count;
	init();
	for(i=1;i<=l;i++){
		for(j=1;j<=w;j++){
			R[i][j]=R[i][j]+R[i-1][j]+R[i][j-1]-R[i-1][j-1];
		}
	}
	
	for(a=0;a<l;a++)
		for(b=0;b<w;b++)
			for(c=a,d=b;c<=l&&d<=w;c++,d++){
				sum=checksquare(a,b,c,d);
				if(sum!=0){
					for(i=a+1,p=1;i<=c;i++,p++){
						for(j=b+1,q=1;j<=d;j++,q++){
							if(in[i][j]=='P')	temp[p][q]='P';
							else temp[p][q]='-';
						}
					}
					m=c-a;
					n=d-b;
					count=0;
					for(i=1;i<=m;i++){
						for(j=1;j<=n;j++){
							if(temp[i][j]=='P'){
								count++;
								clear_P(i,j);
							}
						}
					}
					if(max<sum){
						max=sum;
						min=count;
					}
					else if(max==sum){
						if(min>count) min=count;
						
					}
				}
			}
	if(max==-9999 && min==9999){
		printf("0 0\n");
	}
	else printf("%d %d\n",max,min);
	return 0;
}
