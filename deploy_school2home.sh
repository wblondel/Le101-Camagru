#!/usr/bin/env bash
echo "Compressing project... "
tar --exclude='.git' --exclude='.idea' --exclude='*.bak' --exclude='*.example' --exclude='*.sh' --exclude='*.iml' --exclude='.gitignore' --exclude='.gitmodules' --disable-copyfile -czvf /tmp/camagru.tar.gz .
echo "DONE"

echo "Removing distant folder"
ssh root@51.15.122.154 -i ~/.ssh/scaleway 'rm -rf /var/www/camagru.williamblondel.fr/{*,.*}'
echo "DONE"

echo "Extracting project to distant folder"
cat /tmp/camagru.tar.gz | ssh root@51.15.122.154 -i ~/.ssh/scaleway "cd /var/www/camagru.williamblondel.fr; tar zxvf -"
echo "DONE"
