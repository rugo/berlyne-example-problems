CFLAGS=-s -static -std=c99 -Wall -m32
LDFLAGS=-lc

OBJ = gfx.o watchdog.o snake.o main.o
BIN = snake


.PHONY: clean

all:snake

$(BIN): $(OBJ)
	$(CC) $(CFLAGS) -o $@ $(OBJ) $(LDFLAGS)

%.o: %.c
	$(CC) $(CFLAGS) -c $<

clean:
	rm -rf $(BIN) $(OBJ)
