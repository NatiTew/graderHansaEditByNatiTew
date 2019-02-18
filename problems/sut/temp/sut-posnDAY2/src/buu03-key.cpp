/*
TASK: KEY
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>

char compare(char up,char down,char key)
{
	if(up>=down && up<=key || up>=key && up<=down)
		return up;
	if(down>=up && down<=key || down>=key && down<=up)
		return down;
	return key;
}

int main()
{
	short a,L,K,left,right,startc,endc,runc;
	char up[130],down[130],key[130];

	scanf("%hd %hd",&L,&K);
	scanf("%s %s %s",&up[1],&down[1],&key[1]);
	
	startc=1;
	endc=1;
	left=K;
	right=K;

	while(1)
	{
		runc=startc;
		for(a=left;a<=right;a++)
		{
//			printf("%c %c %c get %c\n",up[runc],key[a],down[runc],compare(key[a],up[runc],down[runc]));
			key[a]=compare(key[a],up[runc],down[runc]);
			runc++;
		}
//	printf(".%s.\n",&key[1]);
		left--;
		if(left<1)
		{
			left=1;
			startc++;
		}
		endc++;
		if(endc>L)
			right--;
		if(left==1 && right==0)
			break;
	}

	printf("%s\n",&key[1]);

	return 0;
}
