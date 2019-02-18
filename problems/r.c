#include <stdio.h>
#include <time.h>
int main(void)
{
 int num=0;
 int i=0;
 int number=0;
 int seed=0;
 srand(time(NULL));
 num = (rand()%200)+1;
 printf("%d\n",num);
 for(i=0;i<=num;i++)
 {
   number=(rand()%30000)+1;
   seed = rand()%2;
   printf("%d\n",number);
 }
 return(0);
}
