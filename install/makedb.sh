#!/bin/bash

echo "Enter the root password for mysql"

mysql -u root -p < ./createdb.sql

sudo chmod 777 ../likedislike/sql/run.sh
