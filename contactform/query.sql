create table contact_form(
    id int auto_increment primary key,
    name varchar(100) not null,
    email varchar(100) not null,
    phone varchar(20) not null,
    message text not null,
);
