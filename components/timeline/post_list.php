<?php
  include_once "../bd.php";
  $sql = 'SELECT 
            post.id,
            post.descricao,
            post.imagem,
            post.data_publicacao,
            pessoa.nome,
            pessoa.avatar
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
    $avatar = $registro['avatar'];
    echo (
      "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
        <img src='$avatar' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
        <span class='w3-right w3-opacity'>$data_publicacao</span>
        <h4>$nome</h4><br>
        <hr class='w3-clear'>
        <img src='$imagem' style='width:100%' class='w3-margin-bottom'>
        <p>$descricao</p>
        <a href='javascript:curtir($id_post);' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up'></i>  Curtir</a> 
        <a href='comentarios.php' type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comentar</a> 
      </div>"
    );
  }
?>

<?php
if ($_POST["acao"] == "like") {
	include_once "../bd.php"; 
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
