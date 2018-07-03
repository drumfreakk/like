# Like/Dislike Counter

**About**

A like/dislike counter for websites in javascript, php and mysql

**Instalation**

1. Put everything in this layout on a webserver (i.e. an apache server)
1. Make install/install.sh executable and execute, with the password you want for the mysql account, i.e. ./install.sh password123
  1.It will ask you for the root password of mysql, and then it will add a user and database for the like/dislike button.
1. Once you have run install.sh, you can remove the folder install
1. Take all the contents of the like folder, and put in where you want the like buttons to go
  1. You can merge the like/dislike index.html and your index.html, as long as you copy all everything in the like/dislike index.html
1. (If you want, then sql/del.sh will remove all the likes/dislikes.)
