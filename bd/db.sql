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