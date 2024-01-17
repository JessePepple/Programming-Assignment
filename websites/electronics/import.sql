create database if not exists electronics;
use electronics;

create table if not exists users(id int not null auto_increment, name varchar(255) not null, 
email varchar(100) not null, username varchar(80) not null,
password varchar(255) not null, rank int not null default '0', primary key(id));

create table if not exists categories(id int not null auto_increment, name VARCHAR(100) not null, primary KEY(id));
create table if not exists products(id int not null auto_increment, name varchar(255) not null, description text, manufacturer varchar(255),
image VARCHAR(255), price FLOAT DEFAULT(0), category_id int, Foreign Key (category_id) REFERENCES categories(id), primary key(id));

