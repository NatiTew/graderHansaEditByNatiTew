/*
TASK: KEY
AUTHOR: Sirawit Phutrakul
CENTER: BUU
LANG: C
*/
#include<stdio.h>
#include<stdlib.h>

char up[130] ,down[130] ,key[130] ,sort[3];
int L ,K;

int sort_char(const void *a ,const void *b) {
	return *(char *)a - *(char *)b;
}

int main(void) {
	int i ,j ,k;

	scanf("%d %d" ,&L ,&K);
	scanf("%s %s %s" ,up ,down ,key);
	for(i=0;i<L+K-1;++i) {
		j = i<L ?i : L-1;
		k = i<L ?K-1 :K-(i-L+1)-1;
		for(;j>=0 && k>=0;--j ,--k) {
			sort[0] = up[j];
			sort[1] = key[k];
			sort[2] = down[j];
			qsort(sort ,3 ,sizeof(sort[0]) ,sort_char);
			key[k] = sort[1];
		}
	}
	key[K] = 0;
	printf("%s\n" ,key);
	return 0;
}
