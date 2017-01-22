#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>


int main(int argc, string argv[])
{
    //Make sure the user only gives 1 arg.
    if (argc < 2 || argc > 2)
    {
        printf("This program requires 1 input, a key, to start program.\n");
        return 1;
    }
    
    // Check that the user gave a positive number and is int.
    int key = atoi(argv[1]);
    if (key < 1)
    {
        printf("Please run the program with a positive input.\n");
        return 2;
    }
    
    //Get users input to cipher.
    printf("plaintext: ");
    string input = get_string();
    
    printf("ciphertext: ");
    
    //Cycle through the string given to Cipher.
    int l = strlen(input);
    for(int i = 0; i < l; i++)
    {
        //Set the i'th char to a variable to work with.
        char c = input[i];
        //Test if the char is alphabetic.
        if (isalpha(c))
        {
            //Alphabetic chars get encrypted.
            char txt;
            if(isupper(c))
            {
            txt = ((c - 65) + key) % 26 + 65;
            }
            if(islower(c))
            {
            txt = ((c - 97) + key) % 26 + 97;
            }
            printf("%c", txt);
        }
        else 
        {
            //Not alphabetic, Doesnt get encrypted
            printf("%c", c);
        }
        
    }
    printf("\n");
    
    return 0;
}