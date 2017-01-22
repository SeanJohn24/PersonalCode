#include <cs50.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

bool checksum(char str[], int n);

int main (void)
{
    printf("What is the credit card number to test:");
    long number = get_long_long();
    
    while (number < 1)
    {
        printf("Retry:");
        number = get_long_long();
    }
    
    char str[256];
    sprintf(str, "%ld", number);
    int len = strlen(str);
    
    char f2[3];
    size_t i;
    for (i = 0; i < 2; i++) {
        f2[i] = str[i];
    } f2[i] = '\0';
    int ftwo = atoi(f2);
        
    if (checksum(str, len))
    {
        if ((ftwo == 34 || ftwo == 37) && len == 15 ) {
            printf("AMEX\n");
        } else if (ftwo > 50 && ftwo < 56 && len == 16) {
            printf("MASTERCARD\n");
        } else if ((ftwo > 39 && ftwo < 50) && (len == 15 || len == 16)) {
            printf("VISA\n");
        } else {
            printf("INVALID\n");
        }
    } else {
         printf("INVALID\n");
         
    }
    return 0;
}



bool checksum(char str[], int n)
{
    bool check;
    int x;
    int y;
    int sl;
    int hold;
    int px1;
    int px;
    
    if (n == 16)
    {
        for (int i = 0; str[i] != '\0'; i++)
        {
            int test = i;
            if (test%2 == 0)
            {
                char b = str[i];
                hold = b - '0';
                y = hold * 2;
                char bob[5];
                sprintf(bob, "%i", y);
                int ob = strlen(bob);
                if (ob == 1)
                {
                    x = x + y;
                } else {
                    px = bob[0] - '0';
                    px1 = bob[1] - '0';
                    x = x + px + px1;
                }
                //printf(",X is: %i, bob is: %s, ob is: %i count: %i \n", x, bob, ob, i);
            } else {
                char b = str[i];
                hold = b - '0';
                x = x + hold;
                //printf("B is: %c, X is: %i, count: %i \n", b, x, i);
            }
        }
    
                char sum[5];
                sprintf(sum, "%i", x);
                sl = strlen(sum);
                sl = sl - 1;
                
                if (sum[sl] == '0')
                {
                    check = true;
                    //printf("%s\n", sum);
                } else {
                    check = false;
                    //printf("%s\n", sum);
                }        
    } else {
        for (int i = 0; str[i] != '\0'; i++)
        {
            int test = i;
            if (test%2 == 0)
            {
                char b = str[i];
                hold = b - '0';
                x = x + hold;
                //printf("B is: %c, X is: %i, count: %i \n", b, x, i);
            } else {
                char b = str[i];
                hold = b - '0';
                y = hold * 2;
                char bob[5];
                sprintf(bob, "%i", y);
                int ob = strlen(bob);
                if (ob == 1)
                {
                    x = x + y;
                } else {
                    px = bob[0] - '0';
                    px1 = bob[1] - '0';
                    x = x + px + px1;
                }
                //printf(",X is: %i, bob is: %s, ob is: %i count: %i \n", x, bob, ob, i);
            }
            char sum[5];
            sprintf(sum, "%i", x);
            sl = strlen(sum);
            sl = sl - 1;
            
            if (sum[sl] == '0')
            {
                check = true;
                //printf("%s\n", sum);
            } else {
                check = false;
                //printf("%s\n", sum);
            }        
            
        }
    }
    return check;
}