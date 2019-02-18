/*
TASK: SMS
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: ACS
*/

#include <stdio.h>

char d[100];
int point;

int check(int x,int y,int count,int point){
	if(x==0&&y==0){
		point--;
	}
	else if(x==0&&y==1){
		count%=3;
		switch(count){
			case 1 : d[point]='A'; point++; break;
			case 2 : d[point]='B'; point++; break;
			case 0 : d[point]='C'; point++; break;
		}
	}
	else if(x==0&&y==2){
		count%=3;
		switch(count){
			case 1 : d[point]='D'; point++; break;
			case 2 : d[point]='E'; point++; break;
			case 0 : d[point]='F'; point++; break;
		}
	}
	else if(x==1&&y==0){
		count%=3;
		switch(count){
			case 1 : d[point]='G'; point++; break;
			case 2 : d[point]='H'; point++; break;
			case 0 : d[point]='I'; point++; break;
		}
	}
	else if(x==1&&y==1){
		count%=3;
		switch(count){
			case 1 : d[point]='J'; point++; break;
			case 2 : d[point]='K'; point++; break;
			case 0 : d[point]='L'; point++; break;
		}
	}
	else if(x==1&&y==2){
		count%=3;
		switch(count){
			case 1 : d[point]='M'; point++; break;
			case 2 : d[point]='N'; point++; break;
			case 0 : d[point]='O'; point++; break;
		}
	}
	else if(x==2&&y==0){
		count%=4;
		switch(count){
			case 1 : d[point]='P'; point++; break;
			case 2 : d[point]='Q'; point++; break;
			case 3 : d[point]='R'; point++; break;
			case 0 : d[point]='S'; point++; break;
		}
	}
	else if(x==2&&y==1){
		count%=3;
		switch(count){
			case 1 : d[point]='T'; point++; break;
			case 2 : d[point]='U'; point++; break;
			case 0 : d[point]='V'; point++; break;
		}
	}
	else if(x==2&&y==2){
		count%=4;
		switch(count){
			case 1 : d[point]='W'; point++; break;
			case 2 : d[point]='X'; point++; break;
			case 3 : d[point]='Y'; point++; break;
			case 0 : d[point]='Z'; point++; break;
		}
	}
    return point;
}

int main(){
	int n,st,count,a,b,x=0,y=0;
	scanf(" %d ",&n);
	scanf(" %d %d ",&st,&count);
	point=0;
	switch(st){
		case 2 : x=0; y=1; point=check(x,y,count,point); break;
		case 3 : x=0; y=2; point=check(x,y,count,point); break;
		case 4 : x=1; y=0; point=check(x,y,count,point); break;
		case 5 : x=1; y=1; point=check(x,y,count,point); break;
		case 6 : x=1; y=2; point=check(x,y,count,point); break;
		case 7 : x=2; y=0; point=check(x,y,count,point); break;
		case 8 : x=2; y=1; point=check(x,y,count,point); break;
		case 9 : x=2; y=2; point=check(x,y,count,point); break;
	}
	n--;
	while(n--){
		scanf(" %d %d %d ",&a,&b,&count);
		y+=a;
		x+=b;
		if(x==0&&y==0&&point==0) continue;
		point=check(x,y,count,point);
	}
	d[point]='\0';
	if(point==0)
		printf("null\n");
	else
		printf("%s\n",d);
	return 0;
}