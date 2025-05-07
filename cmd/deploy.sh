#!/bin/sh

run_as_root() {
  [ "${UID}" -ne "0" ] && sudo -p "Enter pass: " "$@" || "$@"
}

db_file="db/boygang.db"
if [ -e "$db_file" ];
then
    rm $db_file
fi

run_as_root pacman -S nginx php-fpm php sqlite mailcap php-sqlite
run_as_root cp -r config/php.ini /etc/php/
php db/init.php
run_as_root cp *.{php,js,css} /usr/share/nginx/html/
run_as_root cp -r img db info /usr/share/nginx/html/
run_as_root cp -r config/nginx.conf /etc/nginx/nginx.conf
run_as_root systemctl enable --now php-fpm.service
run_as_root systemctl enable --now nginx.service
