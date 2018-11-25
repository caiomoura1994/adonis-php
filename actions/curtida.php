<?php
include('../bd.php');
if ($_POST["acao"] == "like") {
  session_start();
  $userId=$_SESSION['id_usuario'];
	$id_post = $_POST["postagem"];
	$sql_seleciona_se_ja_teve_curtida = "SELECT * 
			FROM curtida
			WHERE id_pessoa = '$userId'
			AND id_post = '$id_post'";

	$sql_query_count = "SELECT COUNT(id) AS qtd_likes FROM curtida WHERE id_post = '$id_post'";

	$retorno = $con->query($sql_seleciona_se_ja_teve_curtida);
	if ($retorno == false) {
		$data = array("status"=>false, "msg"=>$con->error);
		echo json_encode($data);
		exit;
	}

	if ( $registro = $retorno->fetch_array() ) {
		$curtida_id = $registro['id'];

		$sql_query_delete = "DELETE FROM curtida WHERE id = '$curtida_id'";
		$con->query($sql_query_delete);
		$retorno = $con->query($sql_query_count);
		$registro = $retorno->fetch_array();

		$qtd_likes = $registro["qtd_likes"];
		$data = array("status"=>true, "curtido"=>false, "curtidas_contador"=>$qtd_likes);
		echo json_encode($data);
		exit;
	}

	$sql_insert_curtida = "INSERT INTO curtida (`id_pessoa`, `id_post`) VALUES ('$userId', '$id_post')";
	$retorno = $con->query($sql_insert_curtida);
	if ($retorno == true) {
		$retorno = $con->query($sql_query_count);
		$registro = $retorno->fetch_array();
		$qtd_likes = $registro["qtd_likes"];

		$data = array("status"=>true, "curtido"=>true, "curtidas_contador"=>$qtd_likes);
	} else {
		$data = array("status"=>false, "msg"=>"Erro ao curtir!");
	}
}
if ($_POST["acao"] == "listLikes") {
	$id_post = $_POST["postagem"];
	$sql_seleciona_todas_curtidas = "SELECT * 
	FROM curtida
	inner join pessoa on  pessoa.id =curtida.id_pessoa
	where id_post = $id_post";
	$retorno = $con->query($sql_seleciona_todas_curtidas);
	if ($retorno) {
		$curtidas = array();
		while ($registro = $retorno->fetch_array()) {
			$array_registro = array(
				"avatar"=>$registro['avatar'],
				"nome"=>$registro['nome'],
				"id"=>$registro['id_pessoa'],
			);
			array_push($curtidas, $array_registro);
		}
		$data = $curtidas;
	}
}
echo json_encode($data);
?>
