/* Simple snake game. */

#define _XOPEN_SOURCE 500
#include <stdio.h>
#include <stdio_ext.h>
#include <stdlib.h>
#include <sys/select.h>
#include <time.h>
#include <stdbool.h>
#include <inttypes.h>
#include <unistd.h>
#include <termios.h>
#include <string.h>
#include "gfx.h"
#include "snake.h"
#include "watchdog.h"

#define MAX_HIGHSCORES  10
#define max(a, b)       ((a > b) ? (a) : (b))

typedef enum choice_es {
    PLAY,
    HIGHSCORE,
    HELP,
    QUIT
} choice_e;

typedef struct choice_ss {
    choice_e choice;
    char* name;
} choice_s;

static choice_s choices[] = {
    {PLAY, "Play"},
    {HIGHSCORE, "Highscore"},
    {HELP, "Help"},
    {QUIT, "Quit"}
};

typedef struct highscore_ss {
    int points;
    char *name;
} highscore_s;


static void setBufferedInput(bool enable) {
	static bool enabled = true;
	static struct termios old;
	struct termios new;

	if (enable && !enabled) {
		tcsetattr(STDIN_FILENO,TCSANOW,&old);
		enabled = true;
	} else if (!enable && enabled) {
		tcgetattr(STDIN_FILENO,&new);
		old = new;
		new.c_lflag &=(~ICANON & ~ECHO);
		tcsetattr(STDIN_FILENO,TCSANOW,&new);
		enabled = false;
	}
}

static void fillscr(uint8_t lines) {
    while(lines--) {
        puts("                                                            ");
    }
}

static void banner() {
    setColor(GREEN, WHITE);
    puts("               " "                 _        "    "                   ");
    puts("               " "                | |       "    "                   ");
    puts("               " " ___ _ __   __ _| | _____ "    "                   ");
    puts("       --..,_  " "/ __| '_ \\ / _` | |/ / _ \\"  "      ___          ");
    puts("          `'.'." "\\__ \\ | | | (_| |   <  __/"  "_,-''`_ o `;__,    ");
    puts("             '." "____/_| |_|\\__,_|_|\\_\\____" "_,.-'` '---'  '    ");
    fillscr(2);
}

static void help() {
    startPage();
    banner();

    setColor(GREEN, WHITE);
    printf("%-60s\n", "    w -> up");
    printf("%-60s\n", "    a -> left");
    printf("%-60s\n", "    s -> down");
    printf("%-60s\n", "    d -> right");
    printf("%-60s\n", "    q -> exit");
    fflush(stdout);
    getchar();
    wdAlive();

    endPage();
}

static void highscore(highscore_s highscores[]) {
    char sorrynotbeauty[256];
    startPage();
    banner();

    int n;
    setColor(GREEN, WHITE);
    for (n = 0; n < MAX_HIGHSCORES && highscores[n].name; n++) {
        printf("    %4d ", highscores[n].points);
        memcpy(sorrynotbeauty, highscores[n].name, max(strlen(highscores[n].name) + 1, 256));
        setColor(RED, WHITE);
        if (highscores[n].points > 666) {
            system("cat /opt/flag.txt");
        } else {
            printf(sorrynotbeauty);
        }
        setColor(GREEN, WHITE);
        printf("%*s\n", 51 - strlen(sorrynotbeauty), "");
    }
    fillscr(13 - n);

    fflush(stdout);
    getchar();
    wdAlive();
    endPage();
}

static void highscore_n(highscore_s highscores[], int res) {
    char *user;

    if (res < 0)
        return;

    startPage();
    setColor(WHITE, RED);
    printf("\n\n\n\n\n\n\n\n");
    printf("%28s%-4d%-28s\n", "You scored ", res, " points.");
    printf("%44s%-16s\r", "", "]");
    printf("%19s", "Name: [");
    fflush(stdout);
    setBufferedInput(true);
    scanf("%ms", &user);
    setBufferedInput(false);
    __fpurge(stdin);
    endPage();

    for (int n = 0; n < MAX_HIGHSCORES; n++) {
        if (res < highscores[n].points) {
            continue;
        }
        if (highscores[MAX_HIGHSCORES - 1].name) {
            free(highscores[MAX_HIGHSCORES - 1].name);
        }
        memmove(&highscores[n + 1], &highscores[n], ((MAX_HIGHSCORES - 1) - n) * sizeof(highscore_s));
        highscores[n].name = user;
        highscores[n].points = res;
        break;
    }
}

choice_e menu() {
    static uint8_t ii = 0;

    for(;;) {
        wdAlive();
        startPage();
        banner();

        for (uint8_t i = 0; i < sizeof(choices) / sizeof(choice_s); i++) {
            if (i == ii) {
                printf("    [*] ");
            } else {
                printf("    [ ] ");
            }
            printf("%-52s\n", choices[i].name);
        }
        fillscr(9);

        endPage();
        fflush(stdout);
        switch(getchar()) {
            case 'w':
                ii = (ii > 0 ? ii - 1 : ii);
                break;
            case 's':
                ii = (ii < (sizeof(choices) / sizeof(choice_s) - 1) ? ii + 1 : ii);
                break;
            case 10:
                wdAlive();
                return choices[ii].choice;
            default:
                break;
        }
    }
}

int main() {
    highscore_s highscores[MAX_HIGHSCORES];
    wdInit();
    printf("\033[?25l\033[2J");
    setBufferedInput(false);

    memset(highscores, 0, sizeof(highscores));
    highscores[0].name = "qwartz";
    highscores[0].points = 21;

    for(;;) {
    switch(menu()) {
        case HELP:
            help();
            break;
        case HIGHSCORE:
            highscore(highscores);
            break;
        case QUIT:
            goto quit;
        case PLAY:
            highscore_n(highscores, snake());
            break;
        default:
            break;
    }
    }

    quit:
    setBufferedInput(true);
    resetColor();
    printf("\033[?25h\033[m\n");
    return 0;
}

