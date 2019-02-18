/*
TASK: SMS
LANG: C
AUTHOR: Jittapon Busarakum
CENTER: BUU
*/

#include <stdio.h>


char mobile[9][4]={{'D','E','L'},
					{'A','B','C'},
					{'D','E','F'},
					{'G','H','I'},
					{'J','K','L'},
					{'M','N','O'},
					{'P','Q','R','S'},
					{'T','U','V'},
					{'W','X','Y','Z'}};
int	nMobile[9]={0,3,3,3,3,3,4,3,4};
int ad[3][3]={{1,2,3},
				{4,5,6},
				{7,8,9}};
char word[100],size;

void play(int s,int m){
	int choose;
	if(s==0){
		while(size && m){
			m--;
			size--;
		}
		if(size<0) size=0;
	}
	else if(s==6 || s==8){
		choose=m%nMobile[s];
		if(choose==1) word[size]=mobile[s][0];
		else if(choose==2) word[size]=mobile[s][1];
		else if(choose==3) word[size]=mobile[s][2];
		else if(choose==0) word[size]=mobile[s][3];
		size++;
	}
	else{
		choose=m%nMobile[s];
		if(choose==1) word[size]=mobile[s][0];
		else if(choose==2) word[size]=mobile[s][1];
		else if(choose==0) word[size]=mobile[s][2];
		size++;
	}
}

int main(){
	int r,c,n,s,m,h,v,go;
	scanf("%d",&n);
	scanf("%d %d",&s,&m);
	size=0;
	play(s-1,m);
	go=0;
	for(r=0;r<3;r++){
		for(c=0;c<3;c++){
			if(ad[r][c]==s){
				go=1;
				break;
			}
		}
		if(go) break;
	}
	for(n=n-1;n>0;n--){
		scanf("%d %d %d",&h,&v,&m);
		r=r+v;
		c=c+h;
		if(r<0) r=0;
		if(c<0) c=0;
		if(r>2) r=2;
		if(c>2) c=2;
		play(ad[r][c]-1,m);
		
	}
	word[size]='\0';
	if(size==0) printf("null\n");
	else printf("%s\n",word);
	return 0;
}
