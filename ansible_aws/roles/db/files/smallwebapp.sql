/* Set root password */
UPDATE mysql.user SET Password=PASSWORD('<rootpassword>') WHERE User='root';

/* Drop anonymous users */
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');

/* Drop test database */
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
FLUSH PRIVILEGES;

/* Create smallwebapp database */
DROP DATABASE IF EXISTS smallwebapp;
CREATE DATABASE smallwebapp;

/* Create user and set password */
CREATE USER 'swa'@'%' IDENTIFIED BY '<swapassword>';
GRANT ALL on smallwebapp.* to 'swa'@'%';
FLUSH PRIVILEGES;

/* Create DB structure */
USE smallwebapp
CREATE TABLE pets(pet_id int not null auto_increment primary key,pet_name varchar(50) not null);
insert into pets (pet_name) values('Cats');
insert into pets (pet_name) values('Dogs');
CREATE TABLE customers(cust_name varchar(255) not null primary key, cust_color char(7) not null, cust_pet int, FOREIGN KEY fk_pet(cust_pet) REFERENCES pets(pet_id) ON UPDATE CASCADE ON DELETE RESTRICT);

