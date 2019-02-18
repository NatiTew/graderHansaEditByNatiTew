#include <stdio.h>

int main( void )
{
     int   x = 2 , y = -4 , i;               

     for (y = -4; y <= 4; ++y ) {

          int       p = 1;                      
          int       n;                  
          int       neg;                  

          if ( y < 0 ) {                       
               neg = 1;                 
               n = -y;                 
          } else {
               neg = 0;             
               n = y;
          }

          for (i = 0; i < n; ++i )
               p *= x;

          if ( neg )
		printf ("%d ^ %d = %lf \n",x,y,1.0/(float)(p));
          else
		printf ("%d ^ %d = %d \n",x,y,p);
     }
     return 0;
}
