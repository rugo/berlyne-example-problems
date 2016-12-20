#!/usr/bin/perl -w
 
use strict;
use CGI;
my $q = new CGI;

my $user = $q->param('user');
my @forbidden_chars = ("&", "|", ";");

foreach (@forbidden_chars)
{
    if (index($user, $_) != -1) {
        die("Die evil hacker, die!!!");
    }
}


print "Content-type: text/html\n\n";
 
print <<"END";
<html><head><title>See user content</title></head><body>
<h1>User Content</h1>
<p>
View user uploaded content:</p>
END

if ($user){
    open(CNT, "/bin/ls /tmp/$user|");
    print while <CNT>;
} else {
    print <<"XXX";
<p>
<form method="get">
<input type="text" name="user" value="achim" />
<input type="submit" value="Send"/>
</form>
XXX

}

print "</body></html>"
