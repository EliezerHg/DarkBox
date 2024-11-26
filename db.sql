drop database darkbox;
create database darkbox;
use darkbox;

create table users(
    id_user int primary key auto_increment,
    first_name varchar(45) not null,
    last_name varchar(45) not null,
    last_name2 varchar(45) not null,
    email varchar(50) not null unique,
    passw varchar(50) not null,
);

create table files(
    id_file int primary key auto_increment,
    name_file varchar(45),
    file_address varchar(200) not null
    user_file int,
    foreign key (user_file) references users(id_user)
);
-- DROP DATABASE IF EXISTS darkbox;
-- CREATE DATABASE darkbox;
-- USE darkbox;

-- CREATE TABLE users (
--     id_user INT PRIMARY KEY AUTO_INCREMENT,
--     first_name VARCHAR(45) NOT NULL,
--     last_name VARCHAR(45) NOT NULL,
--     last_name2 VARCHAR(45) NOT NULL,
--     email VARCHAR(50) NOT NULL UNIQUE,
--     passw VARCHAR(50) NOT NULL
-- );

-- CREATE TABLE files (
--     id_file INT PRIMARY KEY AUTO_INCREMENT,
--     name_file VARCHAR(45),
--     file_address VARCHAR(200) NOT NULL,
--     user_file INT NOT NULL,
--     FOREIGN KEY (user_file) REFERENCES users(id_user)
-- );