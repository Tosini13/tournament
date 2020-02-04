drop database if exists tournament;
create database tournament;
use tournament;

/* ---------------- */
/* 		CREATE		*/
/* ---------------- */

create table users(
login varchar(20) not null,
password varchar(255) not null,
email varchar(20) not null,
primary key(login));

create table tournament(
id int not null auto_increment,
login varchar(20) not null,
name varchar(100) not null,
participants_qtt int,
group_qtt int,
play_offs_qtt int,
no_last_place int,
tournament_mode int,
start_date datetime,
finish_date datetime,
logo varchar(30),
id_host int,
id_sponsor int,
primary key(id),
foreign key(login) references users(login),
foreign key(id_host) references hosts(id),
foreign key(id_sponsor) references sponsors(id));

create table hosts(
id int not null,
name varchar(50),
website varchar(100),
logo varchar(100),
primary key(id));

create table sponsors(
id int not null,
name varchar(50),
website varchar(100),
logo varchar(100),
primary key(id));

create table group_stage(
id int not null auto_increment,
tournament_id int not null,
teams_qtt int,
name varchar(50),
foreign key(tournament_id) references tournament(id),
primary key(id));


/*
create table play_offs(
id int not null auto_increment,
tournament_id int not null,
round varchar(11),
matches_qtt int,
foreign key(tournament_id) references tournament(id),
primary key(id));

insert into play_offs(tournament_id, round, matches_qtt) values(1, 'Polfinal', 2);
insert into play_offs(tournament_id, round, matches_qtt) values(1, 'Final', 1);
*/

create table play_offs(
id int auto_increment,
qtt int,
round varchar(11),
primary key(id));


create table teams(
id int not null auto_increment,
tournament_id int not null,
group_id int,
name varchar(70),
foreign key(tournament_id) references tournament(id),
foreign key(group_id) references group_stage(id),
primary key(id));

create table matches(
id int not null auto_increment,
tournament_id int not null,
play_offs_id int,
group_id int,
home_id int not null,
away_id int not null,
goal_home int,
goal_away int,
foreign key(tournament_id) references tournament(id),
foreign key(play_offs_id) references play_offs(id),
foreign key(group_id) references group_stage(id),
foreign key(home_id) references teams(id),
foreign key(away_id) references teams(id),
primary key(id));

insert into tournament(login, logo, name, start_date, finish_date) values('krz','pogon.png', 'pierwszy', 20200131120000, 20200203120000);
insert into tournament(login, logo, name, start_date, finish_date) values('krz','pogon2.png', 'drugi', 20200220080000, 20200220230000);
insert into tournament(login, logo, name, start_date, finish_date) values('krz','pogon.png', 'drugipol', 20200131120000, 20200131230000);

insert into group_stage(tournament_id, teams_qtt, name) values(1, 4, 'Grupa Polnocna');
insert into group_stage(tournament_id, teams_qtt, name) values(1, 4, 'Grupa Poludniowa');

insert into play_offs(qtt, round) values(1, 'Final');
insert into play_offs(qtt, round) values(2, 'Polfinal');
insert into play_offs(qtt, round) values(4, 'Cwiercfinal');
insert into play_offs(qtt, round) values(8, '1/16');
insert into play_offs(qtt, round) values(16, '1/32');

insert into teams(tournament_id, group_id, name) values(1, 1, 'FC Barcelona');
insert into teams(tournament_id, group_id, name) values(1, 1, 'MKS Pogon Szczecin');
insert into teams(tournament_id, group_id, name) values(1, 1, 'Chelsea Londyn');
insert into teams(tournament_id, group_id, name) values(1, 1, 'Juventus Turyn');
insert into teams(tournament_id, group_id, name) values(1, 2, 'Manchester City');
insert into teams(tournament_id, group_id, name) values(1, 2, 'Liverpool');
insert into teams(tournament_id, group_id, name) values(1, 2, 'PSG');
insert into teams(tournament_id, group_id, name) values(1, 2, 'SL Salos Szczecin');

insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 1, 2);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 3, 4);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 2, 3);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 4, 1);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 1, 3);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 1, 2, 4);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 5, 6);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 7, 8);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 6, 7);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 8, 5);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 5, 7);
insert into matches(tournament_id, group_id, home_id, away_id) values(1, 2, 6, 8);

insert into matches(tournament_id, play_offs_id, home_id, away_id) values(1, 2, 1, 7);
insert into matches(tournament_id, play_offs_id, home_id, away_id) values(1, 2, 2, 8);

insert into users(email, login, password) values('krz@gmail.com','krz','$2y$10$gUL265FqaLJ/ZlZfbhDj6uuYlnMNhmu6qkYxd8y0FemGG4v3aPHn.');

/* select * from tournament where start_date = 20191226120000; */
/* select * from tournament where start_date < 20191227 order by start_date desc; */


select * from tournament;

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