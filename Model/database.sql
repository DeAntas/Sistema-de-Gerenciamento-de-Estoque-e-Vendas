
-- apenas para facilitar o processo de atualizar a DB no phpmyadmin
-- lembrar de retirar essa linha na versão final
drop database if exists `gerencial`;


create database if not exists `gerencial`;
use gerencial;

create table `perfis_acesso`(
    `id` int primary key not null AUTO_INCREMENT,
    `nome` varchar(40) not null
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;

create table `usuarios`(
    `id` int primary key not null AUTO_INCREMENT,
    `senha` varchar(255) not null,
    `perfil` int not null,
    `nome` varchar(255) not null,
    `qtt_acessos` int not null default 0,
    constraint `fk_perfil` foreign key (`perfil`) references `perfis_acesso`(`id`)
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;

create table `usuarios_pendentes`(
    `id` int primary key not null AUTO_INCREMENT,
    `senha` varchar(255) not null,
    `perfil` int not null,
    `nome` varchar(255) not null,
    `qtt_acessos` int not null default 0,
    constraint `fk_perfil_acesso` foreign key (`perfil`) references `perfis_acesso`(`id`)
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;

create table `armazem`(
    `id` int primary key not null AUTO_INCREMENT,
    `endereco` varchar(255) not null
    
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;

create table `produtos`(
    `id` int primary key not null AUTO_INCREMENT,
    `nome` varchar(40) not null,
    `descricao` varchar(255) not null,
    `quantidade` int not null,
    `preco` float not null,
    `localizacao` int not null,
    `codigo_barras` varchar(255) not null,
    `quantidade_vendida` int default 0,
    constraint `fk_localizacao` foreign key (`localizacao`) references `armazem`(`id`) 
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;

create table `caixa`(
    `id` int primary key not null AUTO_INCREMENT,
    `data_lancamento` date not null,
    `valor` float not null,
    `produto_lancado` varchar(255) not null
)ENGINE=InnoDB DEFAULT CHARACTER SET=latin1;    

insert into `perfis_acesso`(`nome`) values ("gerente");
insert into `perfis_acesso`(`nome`) values ("estoquista");
insert into `perfis_acesso`(`nome`) values ("vendedor");


insert into `usuarios`(`senha`,`perfil`,`nome`) values("senha",1,"Admin");