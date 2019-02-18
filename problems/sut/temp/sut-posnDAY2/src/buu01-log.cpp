/*
TASK: LOGISTICS
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/


#include <stdio.h>
#include <stdlib.h>

typedef struct{
	char h,t;
	int c;
}truck;

typedef struct{
	char h,t;
	float c;
}part;
part way[280];
truck car[280];
int find[280],n,go;
int N,run=0;

int sort_f(const void *a,const void *b){
	truck *tmpa,*tmpb;
	tmpa=(truck*)a;
	tmpb=(truck*)b;
	if(tmpa->h == tmpb->h && tmpa->t == tmpb->t) return tmpa->c - tmpb->c;
	else if(tmpa->h == tmpb->h && tmpa->t!='Y' && tmpb->t!='Y'){
		if(tmpa->t < tmpb->t) return -1;
		else return 1;
	}
	else if(tmpa->h == tmpb->h && (tmpa->t!='Y' || tmpb->t!='Y')){
		if(tmpb->t=='Y') return -1;
		else return 1;
	}
	else if(tmpa->t!='Y' || tmpb->t!='Y'){
		if(tmpa->h < tmpb->h) return -1;
		else return 1;
	}
	else{
		if(tmpa->h < tmpb->h) return -1;
		else return 1;
	}
}

void init(){
	int i;
	char x,y;
	scanf("%d",&N);
	for(i=0;i<N;i++){
		scanf(" %c %c %d",&x,&y,&car[i].c);
		if(x!='X' && x!='Y' && y!='X' && y!='Y'){
			if(x<y){
				car[i].h=x;
				car[i].t=y;
			}
			else{
				car[i].h=y;
				car[i].t=x;
			}
		}
		else if(x=='X'){
			car[i].h=x;
			car[i].t=y;
		}
		else if(x=='Y'){
			car[i].h=y;
			car[i].t=x;
		}
		else if(y=='X'){
			car[i].h=y;
			car[i].t=x;
		}
		else if(y=='Y'){
			car[i].h=x;
			car[i].t=y;
		}
	}
}

void build(){
	int i,j,ind;
	float sum=0.0;
	char x,y;
	for(i=0;i<N;i++){
		x=car[i].h;
		y=car[i].t;
		j=i;
		while(car[j].h==x && car[j].t==y && j<N){
			j++;
		}
		j--;
		way[run].h=car[i].h;
		way[run].t=car[i].t;
		if((j-i+1)%2==1){
			ind=(j+i)/2;
			way[run].c=car[ind].c;
		}
		else{
			ind=(j+i)/2;
			sum=(float)(car[ind].c+car[ind+1].c);
			way[run].c=sum/2;
		}
		run++;
		i=j;
	}
}

void f(int s,char temp){
	int i;
	char non;
	if(temp!='Y' && go==1){
		for(i=0;i<run;i++){
			if(temp==way[i].h && i!=s){
				find[n]=i;
				n++;
				f(i,way[i].t);
				break;
			}
			else if(temp==way[i].t && i!=s){
				find[n]=i;
				n++;
				f(i,way[i].h);
				non=way[i].h;
				way[i].h=way[i].t;
				way[i].t=non;
				break;
			}
		}
		if(i==run) go=0;
	}
}

int main(){
	int i,j;
	float sum;
	init();
	qsort((void*)car,N,sizeof(car[0]),sort_f);
	build();
	n=0;
	find[n]=0;
	n++;
	go=1;
	f(0,way[0].t);
	if(go==0) printf("broken\n");
	else{
		sum=0.0;
		for(i=0;i<n;i++){
			j=find[i];
			printf("%c %c %.1f\n",way[j].h,way[j].t,way[j].c);
			sum+=way[j].c;
		}
		printf("%.1f\n",sum);
	}
	return 0;
}
