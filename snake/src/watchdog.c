#include <time.h>
#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <unistd.h>

static void sighandler(int signum) {
        _exit(0);
}

void wdInit() {
    signal(SIGALRM, sighandler);
    alarm(60);
}

void wdAlive() {
    alarm(30);
}

