/*
TASK: SMS
LANG: C
AUTHOR: Sirawit Phutrakul
CENTER: BUU
*/
#include<stdio.h>

char pad[3][3][5] = {{{-1} ,"ABC" ,"DEF"}
					,{"GHI" ,"JKL" ,"MNO"}
					,{"PQRS" ,"TUV" ,"WXYZ"}
					};
char sms[100];
int len=0 ,x ,y ,m;

void add(void) {
	if(pad[y][x][0]==-1) {
		len = len>m?len-m:0;
	} else {
		if(y==2 && (x==0 || x==2))
			sms[len] = pad[y][x][(m-1)%4];
		else
			sms[len] = pad[y][x][(m-1)%3];
		len++;
	}
}

int main(void) {
	int n ,tmp ,tx ,ty;

	scanf("%d %d %d" ,&n ,&tmp ,&m);
	y = (tmp-1)/3;
	x = (tmp-1)%3;
	add();
	while(--n) {
		scanf("%d %d %d" ,&tx ,&ty ,&m);
		x += tx;
		y += ty;
		add();
	}
	sms[len] = 0;
	if(len)
		printf("%s\n" ,sms);
	else
		printf("null\n");
	return 0;
}
