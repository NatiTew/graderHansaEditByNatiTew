/*
TASK: MOUTAIN
LANG: C
AUTHOR: Sirawit Phutrakul
CENTER: BUU
*/
#include<stdio.h>

int width=0 ,high=0;
char map[11][85];

int main(void) {
	int i ,j ,n ,s ,h;
	for(i=0;i<10;++i)
		for(j=0;j<84;++j)
			map[i][j] = '.';

	scanf("%d" ,&n);
	while(n--) {
		scanf("%d %d" ,&s ,&h);
		if(high<h)
			high = h;
		if(width<s+(h*2)-1)
			width = s+(h*2)-1;
		for(i=0;i<h;++i) {
			for(j=0;j<h-i;++j) {
				if(j) {
					map[i][s+j+i-1] = map[i][s+(2*h)-j-i-2] = 'X';
				} else {
					if(map[i][s+j+i-1]=='\\') {
						map[i][s+j+i-1] = 'v';
					} else if(map[i][s+j+i-1]=='.') {
						map[i][s+j+i-1] = '/';
					}

					if(map[i][s+(2*h)-j-i-2]=='/') {
						map[i][s+(2*h)-j-i-2] = 'v';
					} else if(map[i][s+(2*h)-j-i-2]=='.') {
						map[i][s+(2*h)-j-i-2] = '\\';
					}
				}
			}
		}
	}
	for(i=high;i--;) {
		map[i][width] = 0;
		printf("%s\n" ,map[i]);
	}
	return 0;
}
