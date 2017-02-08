/* Simple snake game. */

#define _XOPEN_SOURCE 500
#include <stdio.h>
#include <stdlib.h>
#include <sys/select.h>
#include <time.h>
#include <stdbool.h>
#include <inttypes.h>
#include <unistd.h>
#include <string.h>
#include "gfx.h"
#include "snake.h"
#include "watchdog.h"

typedef enum direction_es {
    UP,
    DOWN,
    LEFT,
    RIGHT
} direction_e;

typedef struct snake_ss {
    struct snake_ss *next, *prev;
    uint8_t x, y;
    uint8_t color;
} snake_s;

typedef struct food_ss {
    uint8_t x,y;
    uint8_t color;
} food_s;

static uint8_t board[BOARD_W][BOARD_H];
static snake_s *snakef, *snakel;
static direction_e direction;
static food_s food;
static bool quit;
static bool died;
static int score;

static void drawBoard() {
    int w,h;
    static uint8_t b[BOARD_W][BOARD_H];

    memcpy(b, board, sizeof(board));
    for (snake_s *s = snakef; s; s = s->next) {
        b[s->x][s->y] = (s == snakef ? YELLOW : s->color);
    }

    b[food.x][food.y] = food.color;

    startPage();
    setColor(WHITE, RED);
    printf("Score: %-*d\n", BOARD_W * 2 - 7, score);
    for (h = 0; h < BOARD_H; h++) {
        for (w = 0; w < BOARD_W; w++) {
            switch(b[w][h]) {
                case WHITE:
                    setColor(BLACK, WHITE);
                    printf("  ");
                    break;
                case RED:
                    setColor(BLACK, RED);
                    printf("##");
                    break;
                case GREEN:
                    setColor(YELLOW, GREEN);
                    printf("xx");
                    break;
                case YELLOW:
                    setColor(RED, YELLOW);
                    printf("OO");
                    break;
                case BLUE:
                    setColor(YELLOW, BLUE);
                    printf("++");
                    break;
                default:
                    printf("  ");
                    break;
            }
        }
        puts("");
    }
    endPage();
    fflush(stdout);
}

static void initBoard() {
    srand(time(0));

    quit = false;
    died = false;
    score = 0;

    for (int w = 0; w < BOARD_W; w++) {
        for (int h = 0; h < BOARD_H; h++) {
            if (!w || !h || w == BOARD_W - 1 || h == BOARD_H - 1)
                board[w][h] = RED;
            else
                board[w][h] = WHITE;
        }
    }

    snakef = snakel = malloc(sizeof(snake_s));
    snakef->next = snakef->prev = NULL;
    snakef->x = BOARD_W / 2;
    snakef->y = BOARD_H / 2;
    snakef->color = GREEN;

    food.x = 1 + rand() % (BOARD_W - 2);
    food.y = 1 + rand() % (BOARD_H - 2);
    food.color = BLUE;

    direction = LEFT;
}

static void step() {
    char c;
    fd_set readfds;
    FD_ZERO(&readfds);
    FD_SET(STDIN_FILENO, &readfds);

    struct timeval timeout;
    timeout.tv_sec = 0;
    timeout.tv_usec = 0;

    wdAlive();

    c = 0;
    while (select(1, &readfds, NULL, NULL, &timeout)) {
        c = getchar();
    }

    if (c) {
        switch(c) {
            case 'w':
                direction = (direction == DOWN ? DOWN : UP);
                break;
            case 'a':
                direction = (direction == RIGHT ? RIGHT: LEFT);
                break;
            case 's':
                direction = (direction == UP ? UP : DOWN);
                break;
            case 'd':
                direction = (direction == LEFT ? LEFT : RIGHT);
                break;
            case 'q':
                quit = true;
                return;
            default:
                break;
    }
    }

    snake_s *snaken = malloc(sizeof(snake_s));
    snaken->next = snakef;
    snaken->prev = NULL;
    snaken->x = snakef->x;
    snaken->y = snakef->y;
    snaken->color = snakef->color;
    snakef->prev = snaken;
    snakef = snaken;

    switch(direction) {
        case LEFT:
            snakef->x -= 1;
            break;
        case RIGHT:
            snakef->x += 1;
            break;
        case UP:
            snakef->y -= 1;
            break;
        case DOWN:
            snakef->y += 1;
            break;
        default:
            break;
    }

    if (board[snakef->x][snakef->y] == RED) {
        died = true;
        return;
    }

    if (snakef->x == food.x && snakef->y == food.y) {
        food.x = 1 + rand() % (BOARD_W - 2);
        food.y = 1 + rand() % (BOARD_H - 2);
        score++;
    } else {
        snakel = snakel->prev;
        free(snakel->next);
        snakel->next = NULL;
    }

    for (snake_s *s = snakef->next; s; s = s->next) {
        if (snakef->x == s->x && snakef->y == s->y) {
            died = true;
            return;
        }
    }
}

int snake() {
    initBoard();

    while(!quit && !died) {
        drawBoard();
        usleep(500*1000);
        step();
    }

    for (snake_s *s = snakef; s;) {
        snake_s *ss = s->next;
        free(s);
        s = ss;
    }

    return quit ? -1 : score;
}

