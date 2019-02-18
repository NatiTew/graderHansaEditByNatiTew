/*
TASK: KEY
LANG: C
AUTHOR: Akarapon Watcharapalakorn
CENTER: BUU
*/
#include <stdio.h>

int main(){
	int nmother,nkey,i,j,k;
	char a[300]={0},b[300]={0},key[300]={0};
	scanf(" %d %d ",&nmother,&nkey);
	scanf(" %s %s %s ",a,b,key);
	for(i=0;i<nmother;i++){   /*Change key to last lock*/
		k=nkey-1;
		for(j=i;j>=0;j--,k--){
			if(key[k]<=a[j]&&key[k]<=b[j]){
				if(a[j]<=b[j])
					key[k]=a[j];
				else
					key[k]=b[j];
			}
			else if(key[k]>=a[j]&&key[k]>=b[j]){
				if(a[j]>=b[j])
					key[k]=a[j];
				else
					key[k]=b[j];
			}
		}
	}
	for(i=nkey-2;i>=0;i--){ /*Change any key that in lock*/
		k=i;
		for(j=nmother-1;j>=0;j--,k--){
			if(key[k]<=a[j]&&key[k]<=b[j]){
				if(a[j]<=b[j])
					key[k]=a[j];
				else
					key[k]=b[j];
			}
			else if(key[k]>=a[j]&&key[k]>=b[j]){
				if(a[j]>=b[j])
					key[k]=a[j];
				else
					key[k]=b[j];
			}
		}
	}
	printf("%s\n",key);
	return 0;
}
