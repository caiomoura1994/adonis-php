<?php
  include "../bd.php";
  $sql = 'SELECT 
            post.id,
            post.descricao,
            post.imagem,
            pessoa.nome,
            pessoa.avatar,
            pessoa.id as profile_id,
            DATE_FORMAT(post.data_publicacao, "%d/%m/%Y") AS data_publicacao
          FROM post
          INNER JOIN pessoa
          ON post.id_pessoa = pessoa.id
          ORDER BY post.id desc;
  ';
  $retorno = $con->query($sql);
  if ($retorno == false) {
    echo $retorno->error;
  }
  while ($registro = $retorno->fetch_array()) {
    $descricao = $registro['descricao'];
    $id_post = $registro['id'];
    $imagem = $registro['imagem'];
    $data_publicacao = $registro['data_publicacao'];
    $nome = $registro['nome'];
    $profile_id = $registro['profile_id'];
    $avatar = $registro['avatar'];
    include('../components/core/post_block.php');
	}
?>

<script>
	function curtir(id_postagem) {
		$.ajax({
			method: "POST",
			url: '/actions/curtida.php',
			dataType: 'json',
			data: { acao: "like", postagem: id_postagem }
		})
		.done(function(result){
			console.log(result);
			if (result.status == 200) {
				// Atualiza a quantidade de likes
				$("#qtd_likes").html(result.likes);
			} else {
				// alert(result.msg);
			}
		});
	}
</script>
