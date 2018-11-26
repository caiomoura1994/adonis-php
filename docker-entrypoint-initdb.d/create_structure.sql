-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `amigo`;
CREATE TABLE `amigo` (
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_pessoa_amigo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  KEY `id_pessoa_amigo` (`id_pessoa_amigo`),
  CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`),
  CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`id_pessoa_amigo`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `amigo` (`status`, `id`, `id_pessoa`, `id_pessoa_amigo`) VALUES
(1,	2,	1,	0);

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comentario` (`id`, `id_pessoa`, `id_post`, `comentario`, `data_comentario`) VALUES
(1,	0,	76,	'testando isso aqui',	'2018-11-25 18:18:28'),
(2,	0,	76,	'SADASDASDASD',	'2018-11-25 19:24:15'),
(3,	1,	76,	'testttt',	'2018-11-25 19:34:27'),
(4,	1,	76,	'matheus cometando',	'2018-11-25 19:34:37'),
(5,	1,	76,	'matheus cometando',	'2018-11-25 19:35:53'),
(6,	1,	76,	'Ã© verdade',	'2018-11-25 23:42:14'),
(7,	1,	76,	'Ã© verdade',	'2018-11-25 23:43:25');

DROP TABLE IF EXISTS `curtida`;
CREATE TABLE `curtida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`),
  CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `curtida` (`id`, `id_pessoa`, `id_post`) VALUES
(66,	0,	75),
(73,	1,	73),
(112,	0,	76),
(118,	1,	72),
(128,	1,	74),
(154,	1,	75),
(156,	1,	76),
(157,	1,	77);

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `avatar` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `sexo` int(11) NOT NULL,
  `nascimento` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pessoa` (`id`, `nome`, `avatar`, `email`, `senha`, `descricao`, `sexo`, `nascimento`) VALUES
(0,	'Caio Moura',	'https://thumbs.jusbr.com/96x96/imgs.jusbr.com/profiles/6963754/images/ce552b74-e0d6-46cd-bd05-d8a5e0a24a48_IMG_20181017_125439.jpg',	'caiomoura1994@gmail.com',	'1234',	'descr',	1,	'1994-11-03'),
(1,	'Matheus ',	'https://plus.google.com/u/0/_/focus/photos/public/AIbEiAIAAABDCOPnqavaprCjYCILdmNhcmRfcGhvdG8qKDQ0ZGNjZjVkOWVlNmQxMTkzM2UxYmZkM2VhZjJjZGE0NTVmNzcyNTUwAQoYQALPspnDd9ihbQphHn2UMmnv?sz=48',	'matheussblima@gmail.com',	'1234',	'descricao',	1,	'1994-01-01'),
(4,	'Katia Serafim de Moura',	'https://scontent.fssa2-2.fna.fbcdn.net/v/t1.0-9/998215_387704107998261_1957375398_n.jpg?_nc_cat=105&_nc_ht=scontent.fssa2-2.fna&oh=ee5bf1fe9195994d6d27606a3be5281a&oe=5CB04AB5',	'lemefinanceiro@gmail.com',	'123',	'desc',	1,	'2014-01-01'),
(5,	'Willia Moura',	'https://scontent.fssa2-2.fna.fbcdn.net/v/t1.0-9/998215_387704107998261_1957375398_n.jpg?_nc_cat=105&_nc_ht=scontent.fssa2-2.fna&oh=ee5bf1fe9195994d6d27606a3be5281a&oe=5CB04AB5',	'lemefinanceiro@gmail.com',	'123',	'desc',	1,	'2014-01-01'),
(6,	'WASHINGTON CARVALHO',	'https://www.gillette.com.br/pt-br/-/media/Gillette_BR/Images/Editorials/Articles/Beard%20Styles/guy2.png',	'W@2.W',	'1234',	'',	1,	'2014-01-01');

DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets` (
  `quer_cruzar` tinyint(1) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `avatar` varchar(5000) NOT NULL,
  `data_nascimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pets` (`quer_cruzar`, `nome`, `id`, `id_pessoa`, `descricao`, `avatar`, `data_nascimento`) VALUES
(1,	'matheus',	2,	0,	'ta doidÃ£o',	'https://i.ytimg.com/vi/yIMvRy9gRPc/hqdefault.jpg',	'2018-11-19 18:35:58'),
(1,	'matheus',	7,	1,	'To pra onda, BB!!',	'https://i2.wp.com/petcaramelo.com/wp-content/uploads/2018/08/cachorro-mais-feio.png?fit=516%2C652&ssl=1',	'2018-11-19 19:06:38'),
(1,	'Sacizeiro',	8,	1,	'Que onda Ã© essa mermÃ£o',	'http://s2.glbimg.com/jEmp8E9fMf8q8k_Lwk4MbAfvCaM=/e.glbimg.com/og/ed/f/original/2016/07/01/cachorro_e_maconha.jpg',	'2018-11-24 14:47:25');

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `imagem` varchar(5000) NOT NULL,
  `data_publicacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `post` (`id`, `id_pessoa`, `descricao`, `imagem`, `data_publicacao`) VALUES
(57,	0,	'123asdas',	'https://i2.wp.com/barbasestilosas.com/wp-content/uploads/2016/05/degrade-com-barba.jpg?resize=639%2C639',	'2018-11-19 17:41:48'),
(58,	0,	'123asdas',	'https://i2.wp.com/barbasestilosas.com/wp-content/uploads/2016/05/degrade-com-barba.jpg?resize=639%2C639',	'2018-11-19 17:41:52'),
(59,	0,	'123asdas',	'https://i2.wp.com/barbasestilosas.com/wp-content/uploads/2016/05/degrade-com-barba.jpg?resize=639%2C639',	'2018-11-19 17:42:07'),
(60,	0,	'dddd',	'https://i2.wp.com/barbasestilosas.com/wp-content/uploads/2016/05/degrade-com-barba.jpg?resize=639%2C639',	'2018-11-19 17:45:57'),
(61,	0,	'nada',	'https://www.gillette.com.br/pt-br/-/media/Gillette_BR/Images/Editorials/Articles/Beard%20Styles/guy2.png',	'2018-11-19 19:33:32'),
(62,	0,	'matheus ta muito pra frente',	'https://i2.wp.com/petcaramelo.com/wp-content/uploads/2018/08/cachorro-mais-feio.png?fit=516%2C652&ssl=1',	'2018-11-19 19:33:55'),
(63,	0,	'maior onda essa matheus',	'https://i.ytimg.com/vi/yIMvRy9gRPc/hqdefault.jpg',	'2018-11-19 19:34:12'),
(64,	0,	'maior onda essa matheus',	'https://i.ytimg.com/vi/yIMvRy9gRPc/hqdefault.jpg',	'2018-11-19 19:34:28'),
(65,	0,	'maior onda essa matheus',	'https://i.ytimg.com/vi/yIMvRy9gRPc/hqdefault.jpg',	'2018-11-19 19:34:52'),
(66,	0,	'',	'',	'2018-11-19 21:45:10'),
(67,	0,	'',	'',	'2018-11-19 21:45:15'),
(68,	0,	'',	'',	'2018-11-19 21:47:46'),
(69,	0,	'',	'',	'2018-11-19 21:49:04'),
(70,	0,	'',	'',	'2018-11-19 21:49:06'),
(71,	0,	'',	'',	'2018-11-19 21:50:56'),
(72,	0,	'',	'',	'2018-11-19 21:51:15'),
(73,	0,	'',	'',	'2018-11-19 21:59:31'),
(74,	0,	'testando post',	'https://i2.wp.com/petcaramelo.com/wp-content/uploads/2018/08/cachorro-mais-feio.png?fit=516%2C652&ssl=1',	'2018-11-20 04:19:38'),
(75,	0,	'testando post',	'https://i2.wp.com/petcaramelo.com/wp-content/uploads/2018/08/cachorro-mais-feio.png?fit=516%2C652&ssl=1',	'2018-11-20 04:29:15'),
(76,	0,	'testando post',	'https://i2.wp.com/petcaramelo.com/wp-content/uploads/2018/08/cachorro-mais-feio.png?fit=516%2C652&ssl=1',	'2018-11-20 04:29:21'),
(77,	1,	'Isso Ã© um test',	'https://static.quizur.com/i/b/584babb55ad323.67922865aaaa.jpg',	'2018-11-26 00:20:44'),
(78,	1,	'Isso Ã© um test',	'https://static.quizur.com/i/b/584babb55ad323.67922865aaaa.jpg',	'2018-11-26 00:20:58'),
(79,	1,	'Isso Ã© um test',	'https://static.quizur.com/i/b/584babb55ad323.67922865aaaa.jpg',	'2018-11-26 00:22:24');

-- 2018-11-26 00:35:16