CREATE DATABASE votes;

CREATE TABLE votes.up (ip CHAR(255));
CREATE TABLE votes.down (ip CHAR(255));

CREATE USER 'wobsite'@'localhost' IDENTIFIED BY 'pswd';
GRANT ALL PRIVILEGES ON votes.* TO 'wobsite'@'localhost';
FLUSH PRIVILEGES;
