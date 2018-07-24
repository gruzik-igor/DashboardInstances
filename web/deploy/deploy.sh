#!/bin/bash


cd /home/igor/Projects/Symfony

instanceName=$1

db_name=$2

new_user=$3

host=$4

new_db_pw=$5

mkdir $instanceName

cd $instanceName

git clone git@github.com:gruzik-igor/DashboardInstances.git .

mysql -uroot -proot -e "CREATE DATABASE $db_name"

mysql -uroot -proot -e "CREATE USER '$new_user'@'$host' IDENTIFIED BY '$new_db_pw'"

mysql -uroot -proot -e "GRANT USAGE ON *.* TO '$new_user'@'$host' IDENTIFIED BY '$new_db_pw'"

mysql -uroot -proot -e "GRANT ALL privileges ON $db_name.* TO '$new_user'@'$host'"

mysql -uroot -proot -e "FLUSH PRIVILEGES"

composer install

