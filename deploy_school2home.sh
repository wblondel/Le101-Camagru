#!/usr/bin/env bash
echo "Compressing project... "
tar --exclude='.git' --exclude='.idea' --exclude='*.bak' --exclude='*.example' --exclude='*.sh' --exclude='*.iml' --exclude='.gitignore' --exclude='.gitmodules' -czvf /tmp/camagru.tar.gz .
echo "DONE"

echo "Removing distant folder"
ssh 2566335.xyz -p 15250 'rm -rf /usr/share/nginx/camagru.2566335.xyz/{*,.*}'
echo "DONE"

echo "Extracting project to distant folder"
cat /tmp/camagru.tar.gz | ssh 2566335.xyz -p 15250 "cd /usr/share/nginx/camagru.2566335.xyz; tar zxvf -"
echo "DONE"
