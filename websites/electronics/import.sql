create database if not exists electronics;
use electronics;

create table if not exists users(id int not null auto_increment, name varchar(255) not null, 
email varchar(100) not null, username varchar(80) not null,
password varchar(255) not null, rank int not null default '0', primary key(id));

create table if not exists categories(id int not null auto_increment, name VARCHAR(100) not null, primary KEY(id));
create table if not exists products(id int not null auto_increment, name varchar(255) not null, description text, manufacturer varchar(255),
image VARCHAR(255), price FLOAT DEFAULT(0), category_id int, Foreign Key (category_id) REFERENCES categories(id), primary key(id));

create table if not exists questions(id int not null auto_increment, message text not null, product_id int not null,
email varchar(80) not null, status SMALLINT DEFAULT(0), answered SMALLINT DEFAULT(0), date datetime DEFAULT(now()), primary key(id));

create table if not exists answers(id int not null auto_increment, question_id int not null, message text not null,
answered_by int not null, FOREIGN key(answered_by) REFERENCES users(id), date datetime DEFAULT(now()), PRIMARY KEY(id));
