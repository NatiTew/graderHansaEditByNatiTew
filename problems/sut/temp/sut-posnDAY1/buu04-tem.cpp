/*
TASK: TEMP
LANG: C
AUTHOR: Sirawit Phutrakul
CENTER: BUU
*/
#include<stdio.h>

int size ,max;
int map[20][20];

void walk(int x ,int y) {
	int tmp;
	tmp = map[y][x];
	if(max < tmp)
		max = tmp;
	map[y][x] = 100;
	if(0<=x && x<size && 0<=y-1 && y-1<size && map[y-1][x]!=100)
		walk(x ,y-1);
	if(0<=x && x<size && 0<=y+1 && y+1<size && map[y+1][x]!=100)
		walk(x ,y+1);
	if(0<=x-1 && x-1<size && 0<=y && y<size && map[y][x-1]!=100)
		walk(x-1 ,y);
	if(0<=x+1 && x+1<size && 0<=y && y<size && map[y][x+1]!=100)
		walk(x+1 ,y);
	map[y][x] = tmp;
}

int main(void) {
	int i ,j ,x ,y;

	scanf("%d %d %d" ,&size ,&x ,&y);
	x-- ,y--;
	for(i=0;i<size;++i)
		for(j=0;j<size;++j)
			scanf("%d" ,&map[i][j]);
	walk(x ,y);
	printf("%d\n" ,max);
	return 0;
}
