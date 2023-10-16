create database BookDataBase;


use BookDataBase;
create table User(
    id_user int primary key auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    password varchar(50) not null
);
create table Book(
    book_id int primary key auto_increment,
    Title varchar(50) not null,
     Unit double(8,2) not null
   );
   create table BookRent(
    $id  int primary key auto_increment,
    Status bool not null,
    DateRent date not null,
    ExpirationDate date,
    BookId int not null,
	id_user int not null,
    foreign key (book_id) references Book(book_id),
	foreign key (id_user) references User(id_user)
);