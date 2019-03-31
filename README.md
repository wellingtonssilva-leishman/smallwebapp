# SWA - Small Web Application

A simple application made in php, using PDO to interact with MySQL database.

We have three main folders:

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


    ANSIBLE
    |
    --> hosts.ini => inventory file (target servers)
    |
    --> smallwebapp.yaml => Main ansible file
    |
    --> roles
        |
        --> db
        |   |
        |   --> files
        |   |   |
        |   |   --> smallwebapp.sql => Same was one on main DB folder
        |   |
        |   --> tasks
        |       |
        |       --> main.yaml => Main DB tasks list
        |
        --> web
        |   |
        |   --> files
        |   |   |
        |   |   --> 00-base.conf => HTTPD module config file
        |   |   |
        |   |   --> ca.crt  => Certificate CRT
        |   |   |
        |   |   --> ca.csr  => Certificate CSR
        |   |   |
        |   |   --> ca.key  => Certificate Key
        |   |   |
        |   |   --> httpd.conf => WebServer configurations
        |   |   |
        |   |   --> ssl.conf => HTTPS configurations
        |   |   |
        |   |   --> web.tar.gz => Compacted files (Same as on WEB main folder)
        |   |
        |   --> tasks
        |       |
        |       --> main.yaml => Main WEB tasks list
        |
        --> yum
            |
            --> tasks
                |
                --> main.yaml => Main YUM tasks list
