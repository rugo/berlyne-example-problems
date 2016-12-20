cd ..
tar czf sounds.tgz sounds
scp sounds.tgz play:/tmp
ssh play "tar xf /tmp/sounds.tgz -C /var/www/sounds && chmod 777 /var/www/sounds -R"
