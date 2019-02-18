/*
TASK: SCHOOL
AUTHOR: Sirawit Phutrakul
CENTER: BUU
LANG: C
*/
#include<stdio.h>
#include<string.h>

char map[65][70] ,copy[65][70];
int count[64][64];
int W ,L;

void delP(int x ,int y) {
	if(0<=x && x<W && 0<=y && y<L && copy[y][x]=='P') {
		copy[y][x] = 'S';
		delP(x-1 ,y);
		delP(x+1 ,y);
		delP(x ,y-1);
		delP(x ,y+1);
	}
}

int main(void) {
	int i ,j ,k ,x ,y ,size=0 ,po=1000 ,tpo ,min;
	scanf("%d %d" ,&W ,&L);
	for(i=0;i<L;++i) {
		scanf("%s" ,map[i]);
		for(j=0;j<W;++j) {
			if(map[i][j]=='T')
				count[i][j] = 0;
			else {
				if(j)
					count[i][j] = count[i][j-1]+1;
				else
					count[i][j] = 1;
			}
		}
	}
	for(j=W;j--;) {
		for(i=L;i--;) {
			if(count[i][j]) {
				for(min=count[i][j] ,k=0;i-k+1 && count[i-k][j]>k && k<min;++k) {
					if(count[i-k][j]<min)
						min = count[i-k][j];
				}
				if(k>=size) {
					if(k>size)
						po = 1000;
					size = k;
					for(y=0;y<L;++y)
						strcpy(copy[y] ,map[y]);
					for(tpo=y=0;y<size;++y) {
						for(x=0;x<size;++x) {
							if(copy[i-y][j-x]=='P') {
								tpo++;
								delP(j-x ,i-y);
							}
						}
					}
					if(tpo<po)
						po = tpo;
				}
			}
		}
	}
	if(size==0)
		po = 0;
	printf("%d %d\n" ,size*size ,po);
	return 0;
}
