#include <cs50.h>
#include <stdio.h>


int main (void)
{
    printf("How tall should the pyramid be:");
    int max = get_int();
    
    while (max < 0 || max > 23)
    {
        printf("a non-negative integer no greater than 23.\n Retry:");
        max = get_int();
    }
    int curr = 1;
    int spac = max - 1;
    
    for (int i = 0; i < max; i++)
    {
        for (int x = 0; x < spac; x++)
        {
            printf(" ");
        }
        
        for (int y = 0; y < curr; y++)
        {
            printf("#");
        }
        printf("  ");
        for (int z = 0; z < curr; z++)
        {
            printf("#");
        }
        for (int w = 0; w < spac; w++)
        {
            printf(" ");
        }
        printf("\n");
        spac = spac - 1;
        curr = curr + 1;
    }
}

