# SWA - Small Web Application

A simple application made in php, using PDO do interact with MySQL database.

We have two folders:

    DB
    |
    --> smallwebapp.sql => Contains an SQL query to setup the MySQL DB (After a fresh MySQL Server install)

    WEB
    |
    --> db.php => Contains a DB function to open a connection with a MySQL DB
    |
    --> index.php => Home page (shows a form, where submit calls action.php)
    |
    --> action.php => Contains a function to add data from form (index.php) on MySQL DB, and list all customers already added.
