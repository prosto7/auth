<?php
include_once ('classes.php');

$pdo = Tools::connect();  // connect to class Tools, connect DB

// create table users in db sibers 

$users = 'CREATE TABLE users(
id int not null auto_increment primary key,
login varchar(32) not null unique,
pass varchar(128) not null,
roleid int,
email varchar(128) not null,
namefirst varchar(128) not null,
namelast varchar(128) not null, 
age date not null,
gender varchar(128),
imagepath varchar(255),
salt varchar(128)
)default charset="utf8"';


 $pdo->exec($users);
