#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>

int check (char x);


int main(int argc, string argv[])
{
    //Make sure the user only gives 1 arg.
    if (argc < 2 || argc > 2)
    {
        printf("This program requires 1 input, a key, to start program.\n");
        return 1;
    }
    // make sure no non-alphabetic chars are given
    string key = argv[1];
    int foo = 0;
    while (key[foo])
    {
        if (!isalpha(key[foo]))
        {
            printf("Your key must be alphabetic only.\n");
            return 1;
        }
        foo++;
    }
    
    //Get users input to cipher.
    printf("plaintext: ");
    string input = get_string();
    printf("ciphertext: ");
    int klen = strlen(key); //klen = length of key.
    int ilen = strlen(input); // ilen = Length of the input.
    int keycount = 0; // keeping track of what char in the key we are on.
    
        //Cycle through the string given to Cipher.    
        for(int i = 0; i < ilen; i++)
        {
            char c = input[i]; //Set the i'th char to a variable to work with.
            char kc = key[keycount]; // variables to work with.
            int ikey = check(kc); // figure out the offset needed.
            //Test if the char is alphabetic.
            if (isalpha(c))
            {
                //Alphabetic chars get encrypted.
                char txt;
                if(isupper(c))
                {
                txt = ((c - 65) + ikey) % 26 + 65;
                }
                if(islower(c)) 
                {
                txt = ((c - 97) + ikey) % 26 + 97;
                }
                printf("%c", txt);

                
                // check the key count and increment or reset
                if (keycount < (klen - 1))
                {
                    keycount++;                
                }
                else 
                {
                    keycount = 0;
                }   
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


int check (char x)
{
    int out;
    switch (x)
    {
        case 'A' :
        case 'a' :
            out = 0; break;
        case 'B' :
        case 'b' :
            out = 1; break;
        case 'C' :
        case 'c' :
            out = 2; break;
        case 'D' :
        case 'd' :
            out = 3; break;
        case 'E' :
        case 'e' :
            out = 4; break;
        case 'F' :
        case 'f' :
            out = 5; break;
        case 'G' :
        case 'g' :
            out = 6; break;
        case 'H' :
        case 'h' :
            out = 7; break;
        case 'I' :
        case 'i' :
            out = 8; break;
        case 'J' :
        case 'j' :
            out = 9; break;
        case 'K' :
        case 'k' :
            out = 10; break;
        case 'L' :
        case 'l' :
            out = 11; break;
        case 'M' :
        case 'm' :
            out = 12; break;
        case 'N' :
        case 'n' :
            out = 13; break;
        case 'O' :
        case 'o' :
            out = 14; break;
        case 'P' :
        case 'p' :
            out = 15; break;
        case 'Q' :
        case 'q' :
            out = 16; break;
        case 'R' :
        case 'r' :
            out = 17; break;
        case 'S' :
        case 's' :
            out = 18; break;
        case 'T' :
        case 't' :
            out = 19; break;
        case 'U' :
        case 'u' :
            out = 20; break;
        case 'V' :
        case 'v' :
            out = 21; break;
        case 'W' :
        case 'w' :
            out = 22; break;
        case 'X' :
        case 'x' :
            out = 23; break;
        case 'Y' :
        case 'y' :
            out = 24; break;    
        case 'Z' :
        case 'z' :
            out = 25; break;
        default :
            out = 0; break;
    }        
    return out;
}