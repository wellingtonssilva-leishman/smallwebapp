# SWA - Small Web Application

A simple application made in php, using PDO to interact with MySQL database.

We have four main folders:

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

    ANSIBLE_AWS
        |
        --> aws.yaml => Ansible to create all smallwebapp infrastructure on AWS
        |
        --> empty.pem => you should put your own AWS ssk key here
        |
        --> hosts => file used to manage inventory
        |
        --> smallwebapp.yaml => Ansible to install all smallwebapp solution
        |
        -->roles
           |
           --> db
           |   |
           |   --> files
           |      |
           |      --> smallwebapp.sql => Query DB script used during install process - you should set MariaDB root password by replacing <rootpassword> tag, also you should replaces MariaDB swa password by replacing <swapassword> tag
           |   |
           |   --> tasks
           |       |
           |       --> main.yaml => Ansible script to install MariaDB and dependencies
           |
           --> ec2
           |   |
           |   --> tasks
           |   |   |
           |   |   --> main.yaml => Ansible script to create EC2 instances, Security Groups, Load Balancer and dependencies
           |   |        
           |   --> vars
           |       |
           |       --> main.yaml => Variables files you should fill all vars with your AWS account details, and the tag <pemfilename> should be replaced with name of your own AWS ssh key (ex: empty.pem)
           |
           --> keys
           |   |
           |   --> files
           |   |   |
           |   |   --> id_rsa.pub => should be replaced by your own public key file (used by Ansible to get access on AWS hosts)
           |   |
           |   --> tasks
           |       | 
           |        --> main.yaml => Ansible script to copy your public key, inside authorized_keys file on AWS hosts
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
