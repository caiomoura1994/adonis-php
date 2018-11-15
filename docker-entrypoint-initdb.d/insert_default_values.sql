
INSERT INTO `pessoa`
  (`id`, `nome`, `avatar`, `email`, `senha`, `descricao`, `sexo`, `nascimento`) 
VALUES
  (0,	'Caio Moura',	'',	'caiomoura1994@gmail.com',	'1234',	'descricao',	1,	'1994-01-01'),
  (1,	'Matheus ',	'',	'matheussblima@gmail.com',	'1234',	'descricao',	1,	'1994-01-01'),
  (3,	'asdasd',	'asdasd',	'sdas',	'daasda',	'asdas',	1,	'2014-01-01');

INSERT INTO amigo ( id, id_pessoa, id_pessoa_amigo )
   VALUES ( 1, 1, 2);

INSERT INTO comentario ( id, id_pessoa, id_post, comentario, data_comentario )
   VALUES ( 1, 1, 1, 'comentario', '1994-01-01');

INSERT INTO curtida ( id, id_pessoa, id_post )
   VALUES ( 1, 1, 1);

INSERT INTO post ( id, id_pessoa, descricao, imagem, data_publicacao )
   VALUES ( 1, 1, 'comentario', '', '1994-01-01');
