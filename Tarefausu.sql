create database tarefausu;
use tarefausu;

/*----------------------------TABELAS-----------------------------------------*/

create table tbl_usuarios(
       usu_codigo int primary key auto_increment,
       usu_nome varchar(255)not null,
       usu_email varchar(255) not null
);

create table tbl_tarefas(
       tar_codigo int primary key auto_increment,
       tar_setor varchar(255)not null,
       tar_prioridade enum('baixa','m�dia','alta')not null,
       tar_descricao varchar(255)not null,
       tar_status enum('a fazer','fazendo','pronto') not null,
       tar_date date not null
);

/*-----------------INSER��O DE CHAVES ESTRANGEIRAS----------------------------*/

alter table tbl_tarefas
add column usu_codigo int,
add constraint fk_usu_codigo
foreign key(usu_codigo)
references tbl_usuarios(usu_codigo);