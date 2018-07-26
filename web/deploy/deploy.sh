#!/bin/bash

cd /home/igor/Projects/Symfony

instanceName=$1

db_name=$2

new_user=$3

host=$4

new_db_pw=$5

instance_id=$6


mkdir $instanceName

cd $instanceName

git clone git@github.com:gruzik-igor/DashboardInstances.git .

#mysql -uroot -proot -e "CREATE DATABASE $db_name"

#mysql -uroot -proot -e "CREATE USER '$new_user'@'$host' IDENTIFIED BY '$new_db_pw'"

#mysql -uroot -proot -e "GRANT USAGE ON *.* TO '$new_user'@'$host' IDENTIFIED BY '$new_db_pw'"

#mysql -uroot -proot -e "GRANT ALL privileges ON $db_name.* TO '$new_user'@'$host'"

#mysql -uroot -proot -e "FLUSH PRIVILEGES"

composer install --no-interaction --optimize-autoloader



file_path='/home/igor/Projects/Symfony/'$instanceName'/app/config/parameters.yml'

sed -i -e 's/database_name: symfony/database_name: '$db_name'/g' -i -e 's/database_user: root/database_user: '$new_user'/g' -i -e 's/database_password: null/database_password: '$new_db_pw'/' $file_path > parameters.yml

php /home/igor/Projects/Symfony/boomreviews/bin/console app:change:status $instance_id