secret=$(cat secret.c)
rm -rf out challenge.zip
mkdir out
cd out

a=1
b=1
until [ $a -gt ${#secret} ]
do
	echo $secret | cut -c$a-`expr $a + 4` | xargs -d '\n' echo -n > $b.txt
    7z a $b.zip $b.txt -p$(head --bytes 30 /dev/urandom|base64)
	a=`expr $a + 5`
	b=`expr $b + 1`
done

7z a ../challenge.zip *.zip
