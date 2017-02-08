#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <inttypes.h>

#define max(a,b) ((a) > (b) ? (a) : (b))


char *magic(char *a, char *b)
{
    char *c, *d;

    c = d = (char*)malloc(max(strlen(a), strlen(b)) + 14);

    *c++ = 'B';
    *c++ = 'y';
    *c++ = 'e';
    *c++ = '_';
    *c++ = 'B';
    *c++ = 'y';
    *c++ = 'e';
    *c++ = '!';
    *c++ = 0;

    *((uint32_t*)(c)) = (uint32_t)0x67616c66;
    c += 4;
    for (; *a && *b; a++, b++, c++)
    {
        if (*a > *b)
            *c = *a;
        else
            *c = *b;
    }
    *c = 0;

    return d;
}

int main()
{
    char *aloha = magic("{Aaqx_P+aEyeLpk2NwkBTAJmEAvKF9N}","{EZsyX03_Sk_Ald3B4raNJ8V4cF7RUr}");
    puts(aloha);
    free(aloha);
    return 0;
}
