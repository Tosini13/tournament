drop database if exists tournament;
create database tournament;
use tournament;

/* ---------------- */
/* 		CREATE		*/
/* ---------------- */

create table users(
id int auto_increment not null,
login varchar(20) not null,
password varchar(255) not null,
email varchar(20) not null,
primary key(id));


create table tournaments(
id int auto_increment not null,
name varchar(100) not null,
competitors_num int,
start_date datetime,
finish_date datetime,
logo varchar(30),
primary key(id));

create table my_tournaments(
login_user varchar(20) not null,
id_tournament varchar(20) not null,
foreign key(login_user) references users(login),
foreign key(id_tournament) references tournaments(id));

insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'pierwszy', 20191127120000, 20191127120000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'drugi', 20191128120000, 20191129120000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'drugipol', 20191228120000, 20191230160000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'trzeci', 20191229180000, 20191229230000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'drugipol', 20191228120000, 20191228160000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'trzeci', 20191229180000, 20191229230000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'trzecijednatrzecia', 20191226180000, 20191228230000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'trzecipol', 20191227120000, 20191227120000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'czwarty', 20191228120000, 20191228120000);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'xd', 20191229120000, 20191229120000);
insert into tournaments(name, start_date, finish_date) values('tr', 20191230120000, 20191230120000);
insert into tournaments(name, start_date, finish_date) values('asd', 20191231120000, 20191231120000);
insert into tournaments(name, start_date, finish_date) values('asfda', 20200101, 20200101);
insert into tournaments(name, start_date, finish_date) values('afsfgd', 20200102, 20200101);
insert into tournaments(name, start_date, finish_date) values('fsadf', 20200103,20200101);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'sad', 20200104, 20200101);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'zcv', 20200105, 20200101);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'vbnm', 20200106, 20200101);
insert into tournaments(logo, name, start_date, finish_date) values('pogon.png', 'deautch', 20200107, 20200101);
insert into tournaments(logo, name, start_date, finish_date) values('pogon2.png', 'bors', 20200108, 20200101);

insert into users(email, login, password) values('krz@gmail.com','krz','$2y$10$gUL265FqaLJ/ZlZfbhDj6uuYlnMNhmu6qkYxd8y0FemGG4v3aPHn.');

insert into my_tournaments values('krz',4);
insert into my_tournaments values('krz',12);
insert into my_tournaments values('krz',9);
insert into my_tournaments values('krz',1);
insert into my_tournaments values('krz',3);

/* select * from tournaments where start_date = 20191226120000; */
/* select * from tournaments where start_date < 20191227 order by start_date desc; */

select * from users;

/*
tryb (ilość grup,faza pucharowa, rewanże, o miejsca)
prezenter?
Strona prezentera?
Logo – url
Loalizacja – link(gogle maps)
Lokalizacja – nazwa
adres
miasto
kod_pocztowy
liczba_boisk
boisko_główne 
data_rozpoczecie
czas_rozpoczecia
czas_meczu
czas_przerwy
czas_przerwy między fazą grupowa a pucharową
czas_meczu_f_pucharowa
czas_przerwy_f_pucharowa
reguły_gry – table
punkty_za_zwycięstwo
dodatkowe_info
*/