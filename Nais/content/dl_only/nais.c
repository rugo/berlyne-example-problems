#include	<stdlib.h>
#include	<stdio.h>
#include	<err.h>

int	b(void)
{
  system("cat /opt/flag.txt");
  return 0;
}

int	a(void)
{
  char buffer[32];

  printf("What is your password?\n");

  if (read(0, buffer, 1024) <= 0)
    err(EXIT_FAILURE, "read");

  return 0;
}

int	main(int argc, char **argv)
{
  (void) argc, (void) argv;

  printf("If you're cool you'll get a flag.\n");

  return a();
}
