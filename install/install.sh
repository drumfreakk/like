#!/bin/bash

cd $PWD

sudo sed -i "s/password/$1/g" ./createdb.sql
sudo sed -i "s/password/$1/g" ../sql/run.sh

echo "Enter the root password for mysql"

mysql -u root -p < ./createdb.sql

sudo chmod 777 ../sql/run.sh
