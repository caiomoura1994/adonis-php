<?php
  include "../bd.php";
  $sql = 'SELECT
            COUNT(curtida.id_post) as contador_curtidas,
            COUNT(comentario.id_post) as contador_comentarios,
            post.id as post_id,
            post.descricao,
            post.imagem,
            pessoa.nome,
            pessoa.avatar,
            pessoa.id as profile_id,
            DATE_FORMAT(post.data_publicacao, "%d/%m/%Y") AS data_publicacao
          FROM post
          INNER JOIN pessoa ON pessoa.id = post.id_pessoa
          left JOIN curtida ON post.id = curtida.id_post
          left JOIN comentario ON post.id = comentario.id_post
          GROUP BY post.id
          ORDER BY post.id DESC
  ';
  $retorno = $con->query($sql);
  if ($retorno == false) {
    echo $retorno->error;
  }
  $index_post = 0;
  while ($registro = $retorno->fetch_array()) {
    $descricao = $registro['descricao'];
    $id_post = $registro['post_id'];
    $contador_curtidas = $registro['contador_curtidas'];
    $contador_comentarios = $registro['contador_comentarios'];
    $imagem = $registro['imagem'];
    $data_publicacao = $registro['data_publicacao'];
    $nome = $registro['nome'];
    $profile_id = $registro['profile_id'];
    $avatar = $registro['avatar'];
    include('../components/core/post_block.php');
    $index_post = $index_post + 1;
	}
?>

<script>
	function curtir(id_postagem, index_postagem) {
		$.ajax({
			method: "POST",
			url: '/actions/curtida.php',
			dataType: 'json',
			data: { acao: "like", postagem: id_postagem }
		})
		.done(function(result){
			if (result.status) {
        const post_like_counter = document.getElementsByClassName('Post-actions-counter')[index_postagem];
        const post_liked_icon = document.getElementsByClassName('Post-actions-like-icon')[index_postagem];
        post_like_counter.innerText = result.curtidas_contador;
        if (result.curtido) {
          post_liked_icon.className = `animated bounce ${post_liked_icon.className}`;
          post_liked_icon.innerText = 'favorite';
        } else {
          post_liked_icon.innerText = 'favorite_border';
          post_liked_icon.className = 'Post-actions-like-icon material-icons';
        }
			} else {
				alert(result.msg);
			}
		});
	}
</script>
