/*
TASK: SMS
LANG: C
AUTHOR: BENJARONG GULYANAMITTA
CENTER: BUU
*/

#include<stdio.h>

int main()
{
	char sms[100],phone[3][3][5]={{{' '},{'A','B','C'},{'D','E','F'}},
 																{{'G','H','I'},{'J','K','L'},{'M','N','O'}},
																{{'P','Q','R','S'},{'T','U','V'},{'W','X','Y','Z'}}};
	short a,b,N,S,M,psms=0,phy,phx,V,H,temp,letter;

	scanf("%hd %hd %hd",&N,&S,&M);

	for(a=0;a<N;a++)
	{
		if(a==0)
		{
			S--;
			phy=S/3;
  		phx=S%3;
		}
		else if(a>0)
		{
			scanf("%hd %hd %hd",&H,&V,&M);
			phx+=H;
			phy+=V;
			if(phx<0)
				phx=0;
			if(phy<0)
				phy=0;
		}

		if(phx==0 && phy==0)
		{
			for(b=0;b<M;b++)
				psms--;
			if(psms<0)
				psms=0;
			continue;
		}
		else if(phx==0 && phy==2 || phx==2 && phy==2) {
			temp=(M-1+4)%4; }
		else {
			temp=(M-1+3)%3; }
		
		letter=phone[phy][phx][temp];
		sms[psms]=letter;
		psms++;
  }

	if(psms!=0)
	{
		sms[psms]='\0';
		printf("%s\n",sms);
	}
	else
		printf("null\n");

	return 0;
}