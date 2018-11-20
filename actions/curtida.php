<?php
include('../bd.php');
if ($_POST["acao"] == "like") {
  session_start();
  $userId=$_SESSION['id_usuario'];
	$id_post = $_POST["postagem"];
	$sql = "SELECT * 
			FROM curtida
			-- WHERE id_pessoa = '$userId'
			-- AND id_post = '$id_post'";
	$retorno = $con->query($sql);
	if ($retorno == false) {
		$data = array("status"=>false, "msg"=>$con->error);
		echo json_encode($data);
		exit;
  }
  $data = array("status"=>'dasdas', "msg"=>'asdasd', "id"=>'id');
  echo json_encode($data);
  
	// if ( $registro = $retorno->fetch_array() ) {
	// 	$data = array("status"=>false, "msg"=>"Você já curtiu esta postagem!");
	// 	echo json_encode($data);
	// 	exit;
	// }

	// $sql = "INSERT INTO curtida (id_pessoa, id_post) 
	// 		VALUES ('$id_pessoa', '$id_post')";

	// $return = $con->query($sql);

	// if ($retorno == true) {
	// 	$sql = "SELECT COUNT(id) AS qtd_likes 
	// 			FROM curtida 
	// 			WHERE id_post = '$id_post'";

	// 	$retorno = $con->query($sql);
	// 	$registro = $retorno->fetch_array();
	// 	$qtd_likes = $registro["qtd_likes"];

	// 	$data = array("status"=>true, "likes"=>$qtd_likes);

	// } else {
	// 	$data = array("status"=>false, "msg"=>"Erro ao curtir!");
	// }
}
?>
