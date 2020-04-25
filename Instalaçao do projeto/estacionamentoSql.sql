-- create database bd_estacionamento;
 create database forge;
use bd_estacionamento;

create table users(

	id int not null auto_increment,
    name varchar(50) not null,
    email varchar(50) not null,
    password varchar(255) not null,
    updated_at date,
    created_at date,
    primary key(id)
);

create table patios(
	
    id int not null auto_increment,
    data varchar(20),
    dataFinal varchar(20),
	primary key(id)

);
 create table tipos(
	
    id int not null auto_increment,
    tamanho varchar(10),
    primary key(id)
    
    
 
 );
 

create table veiculos(

	id int not null auto_increment,
	placa varchar(7) not null,
    tipoId int,
    patioId int,
    horaEntrada varchar(21),
    horaSaida varchar(21),
    valorTotal double,
    primary key(id),
    foreign key fk_tipoVeiculo(tipoId)
		references tipos(id),
	foreign key fk_patioId (patioId)
		references patios(id)
);





