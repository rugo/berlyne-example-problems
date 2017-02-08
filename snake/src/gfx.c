#include <stdio.h>
#include <inttypes.h>
#include "gfx.h"

void setColor(uint8_t fg, uint8_t bg) {
    static uint8_t fgl = -1;
    static uint8_t bgl = -1;

    if (bgl == bg) {
        if (fgl == fg) {
            return;
        } else {
            printf("\033[%dm", 30 + fg);
            fgl = fg;
            return;
        }
    } else {
        if (fgl == fg) {
            printf("\033[%dm", 40 + bg);
            bgl = bg;
            return;
        } else {
            printf("\033[%d;%dm", 30 + fg, 40 + bg);
            fgl = fg;
            bgl = bg;
        }
    }
}

