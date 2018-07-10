#!/bin/bash

cd $PWD

sudo sed -i "s/wachtwoord/$1/g" ./createdb.sql
sudo sed -i "s/wachtwoord/$1/g" ../sql/del.sh
sudo sed -i "s/wachtwoord/$1/g" ../php/funcs.php

echo "Enter the root password for mysql"

mysql -u root -p < ./createdb.sql

sudo chmod 777 ../sql/del.sh
