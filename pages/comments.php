<?php
  include_once('../components/core/navbar.php');
  error_reporting(1);
  session_start();
  if ($_SESSION["logado"] == NULL) {
      header("Location: ../index.php");
  }
  // conecta ao BD
  include_once "../bd.php";
  $userId=$_SESSION['id_usuario'];

  $post_id = $_GET['post_id'];
  if ($post_id) {
    $filtro = "WHERE post.id = '$post_id'";
  }

  $sql = "SELECT * , DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao
          FROM post
          INNER JOIN pessoa on post.id_pessoa = pessoa.id
          $filtro";

  // Executa a query no BD
  $retorno = $con->query($sql);

  // Deu erro no SQL?
  if ($retorno == false) {
    echo $con->error;
  }

  include_once "../topo.php";
  while ($registro = $retorno->fetch_array()) {    
    $descricao = $registro['descricao'];
    $id_post = $registro['id'];
    $imagem = $registro['imagem'];
    $data_publicacao = $registro['data_publicacao'];
    $nome = $registro['nome'];
    $profile_id = $registro['profile_id'];
    $avatar = $registro['avatar'];
    $disable_comments = true;
  }
?>
<div class="container">
    <h1>Comentarios:</h1>
    <?php include_once('../components/core/post_block.php'); ?>
    <?php include_once('../components/core/comments.php'); ?>
    <div class="row">
        <form class="col s12">
            <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Comentar</label>
                <input type="submit" value="Enviar" class="btn" style="float: right;">
            </div>
            </div>
        </form>
    </div>
<div>
<?php include_once("../rodape.php");?>