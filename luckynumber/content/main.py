#!/usr/bin/env python2
import sys

FLAG_FILE = "/opt/flag.txt"

def getSecret():
    return open(FLAG_FILE).read()

def prime_factor(n):
    i = 2
    while i * i <= n:
        if n % i:
            i += 1
        else:
            n //= i
    return n

def check_number(number):
    """
    Checks if a number is a good lucky number.
    """
    if not isinstance(number, int) or number < 1:
        return False

    for i in range(3):
        number = number << i * i

    if number > 0xAAA:
        return False

    cor = prime_factor(number >> 3) ** 3
    if cor == 8 or cor == 4412:
        return False

    number = number & 0xF0F0 >> 8

    return number << 1 == cor


def main():
    sys.stdout.write("Your lucky number:")
    sys.stdout.flush()
    number = int(input(""))

    if check_number(number):
        print(getSecret())
    else:
        print("Sorry " + str(number) + " is not a good lucky number.")

if __name__ == '__main__':
    try:
        main()
    except BaseException as ex:
        print("Dafuq are you doing?")
