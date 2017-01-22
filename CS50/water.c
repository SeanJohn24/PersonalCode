#include <cs50.h>
#include <stdio.h>

int main (void)
{
    printf("Minutes Showered: ");
    int i = get_int();
    i *= 192;
    i /= 16;
    printf("Bottles consumed: %i\n", i);
}
