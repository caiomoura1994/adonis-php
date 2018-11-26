<?php
  include "../bd.php";
  $timeline_all_posts_sql = 'SELECT
                              COUNT(comentario.id_post) as contador_comentarios,
                              post.id as post_id,
                              post.descricao,
                              post.imagem,
                              pessoa.nome,
                              pessoa.avatar,
                              pessoa.id as profile_id,
                              DATE_FORMAT(post.data_publicacao, "%d/%m/%Y às %H:%i") AS data_publicacao
                            FROM post
                            INNER JOIN pessoa ON pessoa.id = post.id_pessoa
                            left JOIN comentario ON post.id = comentario.id_post
                            GROUP BY post.id
                            ORDER BY post.id DESC';

  $retorno_timeline_all_posts_sql = $con->query($timeline_all_posts_sql);
  if ($retorno_timeline_all_posts_sql == false) {
    echo $retorno_timeline_all_posts_sql->error;
  }
  $index_post = 0;
  while ($registro = $retorno_timeline_all_posts_sql->fetch_array()) {
    $descricao = $registro['descricao'];
    $id_post = $registro['post_id'];
    $contador_curtidas = $registro['contador_curtidas'];
    $contador_comentarios = $registro['contador_comentarios'];
    $imagem = $registro['imagem'];
    $data_publicacao = $registro['data_publicacao'];
    $nome = $registro['nome'];
    $profile_id = $registro['profile_id'];
    $avatar = $registro['avatar'];
    $e_meu_amigo = $con->query("SELECT * FROM amigo where id_pessoa=$userId and id_pessoa_amigo=$profile_id or");
    if ($e_meu_amigo->num_rows || $userId==$profile_id) {
      include('../components/core/post_block.php');
    }
    $index_post = $index_post + 1;
	}
?>
