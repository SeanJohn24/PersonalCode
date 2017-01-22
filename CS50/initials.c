#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <string.h>


int main (void)
{
    // ask user for input. 
    printf("What is your full name:");
    string name = get_string();
    // Make sure the Input has valid value.
    if (name != NULL)
    {
        // Check if the first Char is ' '.
        if (name[0] != ' ')
        {
            // Print the first char if not a space.
            printf("%c", toupper(name[0]));
        }
        // Iterate through the string name.
        for (int i = 0, n = strlen(name); i < n; i++)
        {
            int x = i + 1;
            // Check to see if the i'th char is a space and the i'th + 1 space is not.
            if (name[i] == ' ' && name[x] != ' ')
            {
                //Print the i'th + 1 char if so.
                printf("%c", toupper(name[x]));
            }
        }
        // End the line.
        printf("\n");
    }
    // Return zero, exit program!
    return 0;
}