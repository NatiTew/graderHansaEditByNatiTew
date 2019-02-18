/*
TASK: LOGISTICS
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: BUU
*/

#include <stdio.h>
#include <stdlib.h>

typedef struct{
	char start,end;
	int l;
}w;
w way[300];

int sort(const void* a,const void* b){
	w *p,*q;
	p=(w*)a;
	q=(w*)b;
	if(p->start==q->start&&p->end==q->end)
		return p->l - q->l;
	else if(p->start==q->start)
		return p->end - q-> end;
	else
		return p->start - q->start; 
}

int main(){
	int i,n,ch,chr,j,k,l,c[300]={0};
	float d[300]={0},sum=0;
	char a,b,temp,temp1,temp2,e[300][2]={{0}};
	scanf(" %d ",&n);
	for(i=0;i<n;i++){
		scanf(" %c %c %d ",&a,&b,&way[i].l);
		ch=1;
		if(a=='X'){
			ch=0;
			way[i].start=a;
			way[i].end=b;
		}
		else if(b=='X'){
			ch=0;
			way[i].start=b;
			way[i].end=a;
		}
		if(a=='Y'){
			ch=0;
			way[i].start=b;
			way[i].end=a;
		}
		else if(b=='Y'){
			ch=0;
			way[i].start=a;
			way[i].end=b;
		}
		if(ch){
			if(a<b){
				way[i].start=a;
				way[i].end=b;
			}
			else{
				way[i].start=b;
				way[i].end=a;
			}
		}
	}
	qsort(way,n,sizeof(w),sort);
	temp=way[0].start;
	temp1=way[0].end;
	chr=1;
	l=0;
	for(i=0;i<n;i++){
		ch=1;
		k=0;
		for(j=0;j<n;j++){
			if(way[j].start==temp&&ch){
				ch=0;		
				c[k]=way[j].l;
				k++;
				way[j].start='*';
				way[j].end='*';
			}
			else if(way[j].end==temp&&ch){
				ch=0;
				c[k]=way[j].l;
				k++;
				way[j].start='*';
				way[j].end='*';
			}
			else if((way[j].start==temp&&way[j].end==temp1)||(way[j].start==temp1&&way[j].end==temp)){
				c[k]=way[j].l;
				k++;
				way[j].start='*';
				way[j].end='*';
			}
			else if(way[j].start==temp1){
				temp2=way[j].end;
			}
			else if(way[j].end==temp1){
				temp2=way[j].start;
			}
		}		
		if(k==0){
			chr=0;
			break;
		}
		if(k%2==1){
			d[l]=c[k/2];
			e[l][0]=temp;
			e[l][1]=temp1;
			l++;
		}
		else{
			d[l]=(c[k/2]+c[(k-1)/2])/2.0;
			e[l][0]=temp;
			e[l][1]=temp1;
			l++;
		}
		if(temp1=='Y'){
			break;
		}
		temp=temp1;
		temp1=temp2;
	}
	if(chr){
		for(i=0;i<l;i++){
			printf("%c %c %.1f\n",e[i][0],e[i][1],d[i]);
			sum+=d[i];
		}
		printf("%.1f\n",sum);
	}
	else
		printf("broken\n");
	return 0;
}
