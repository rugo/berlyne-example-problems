#include <inttypes.h>

#define BLACK 0
#define RED 1
#define GREEN 2
#define YELLOW 3
#define BLUE 4
#define MAGENTA 5
#define CYAN 6
#define WHITE 7

#define resetColor() printf("\033[m")
#define startPage() printf("\033[H")
#define endPage() printf("\033[A")

void setColor(uint8_t fg, uint8_t bg);
