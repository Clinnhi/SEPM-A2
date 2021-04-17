drop database if exists management;
create database management;
use management;

create table user(
    user_id serial primary key,
    username varchar(20),
    password char(40),
    email varchar(256) NOT NULL,
    role varchar(10),
    reg_date datetime
);


create table notification(
  location_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  location VARCHAR(256) NOT NULL,
  description TEXT(1024),
  notic_date datetime
  );


insert into user values(01,'admin',SHA('admin'),'123@gmail.com','shift','11/11/11');
insert into user values(02,'staff',SHA('staff'),'456@gmail.com','staff','11/11/11');
insert into notification values(01,'MelbourneShop','Dot forget to go.','11/11/12')