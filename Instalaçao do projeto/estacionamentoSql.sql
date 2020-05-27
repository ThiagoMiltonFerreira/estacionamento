create table users(

	id int not null auto_increment,
    name varchar(50) not null unique,
    email varchar(50) not null,
    password varchar(255) not null,
    updated_at date,
    created_at date,
    primary key(id)
);

create table admin_users(

	id int not null auto_increment,
    name varchar(50) not null,
    tela_entrada_saida_veiculo boolean,
    tela_usuario boolean,
    tela_veiculo_caixa boolean,
    tela_tabela_preco boolean,
    tela_cadastrar_tipo_veiculo boolean,
    primary key (id)

);
-- describe users;
-- A linha abaixo adiciona a coluna que vai vincular a tablea acesso_user com a tablea users, adiciona o campo e logo apos adiciona a foreign key

alter table users add idTipoAdminUser int not null;
alter table users add foreign key fk_adminUsers(idTipoAdminUser) references admin_users(id) ;

-- A linha abaixo, adiciona o primeiro tipo de acesso ao sistema de administrador com acesso em todas as paginas
INSERT INTO `forge`.`admin_users` (`name`, `tela_entrada_saida_veiculo`, `tela_usuario`, `tela_veiculo_caixa`, `tela_tabela_preco`, `tela_cadastrar_tipo_veiculo`) VALUES ('admin', '1', '1', '1', '1', '1');


create table patios(
	
    id int not null auto_increment,
    data varchar(20),
    dataFinal varchar(20),
	primary key(id)

);

-- Cria o primeiro patio do sistema
INSERT INTO `forge`.`patios` (`data`) VALUES ('2020-05-23');  

 create table tipos(
	
    id int not null auto_increment,
    tamanho varchar(10),
    primary key(id)
    
    
 
 );

-- Cria os primeiros tipos de veiculos para a inicializaçao do sistema 
INSERT INTO `forge`.`tipos` (`tamanho`) VALUES ('Pequeno'); 
INSERT INTO `forge`.`tipos` (`tamanho`) VALUES ('Medio'); 
INSERT INTO `forge`.`tipos` (`tamanho`) VALUES ('Grande');
INSERT INTO `forge`.`tipos` (`tamanho`) VALUES ('Moto');  
 

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





