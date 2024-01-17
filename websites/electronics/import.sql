create database if not exists electronics;
use electronics;

create table if not exists users(id int not null auto_increment, name varchar(255) not null, 
email varchar(100) not null, username varchar(80) not null,
password varchar(255) not null, rank int not null default '0', primary key(id));

