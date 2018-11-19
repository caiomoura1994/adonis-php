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

<?php
if ($_POST["acao"] == "like") {
	$cod_post = $_POST["postagem"];
	$cod_autor = 1; // Pegar na sessão (iniciar sessão antes)
	//$cod_autor = $_SESSION["id_usuario"];
	$sql = "SELECT * 
			FROM curtidas 
			WHERE cod_autor = '$cod_autor'
			AND cod_post = '$cod_post'";
	$retorno = $con->query($sql);
	if ($retorno == false) {
		$data = array("status"=>false, "msg"=>$con->error);
		echo json_encode($data);
		exit;
	}

	if ( $registro = $retorno->fetch_array() ) {
		$data = array("status"=>false, "msg"=>"Você já curtiu esta postagem!");
		echo json_encode($data);
		exit;
	}

	$sql = "INSERT INTO curtidas (cod_autor, cod_post) 
			VALUES ('$cod_autor', '$cod_post')";

	$return = $con->query($sql);

	if ($retorno == true) {

		$sql = "SELECT COUNT(id) AS qtd_likes 
				FROM curtidas 
				WHERE cod_post = '$cod_post'";

		$retorno = $con->query($sql);
		$registro = $retorno->fetch_array();
		$qtd_likes = $registro["qtd_likes"];

		$data = array("status"=>true, "likes"=>$qtd_likes);

	} else {
		$data = array("status"=>false, "msg"=>"Erro ao curtir!");
	}
}
?>

<script>
	function curtir(id_postagem) {
		$.ajax({
			method: "POST",
			url: "pages/timeline.php",
			dataType: 'json',
			data: { acao: "like", postagem: id_postagem }
		})
		.done(function(result){
			if (result.status == true) {
				// Atualiza a quantidade de likes
				$("#qtd_likes").html(result.likes);
			} else {
				alert(result.msg);
			}
		})
		.fail(function(){
			alert("Erro ao enviar requisição!");
		});
	}
</script>
