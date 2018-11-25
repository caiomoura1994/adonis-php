<?php
  error_reporting(1);
  session_start();
  $logado = $_SESSION['logado'];
  if (!$logado) {
    echo("
    <script>
      location.href='/';
    </script>
    ");
  }
  include_once('../components/core/navbar.php');
  // conecta ao BD
  include_once "../bd.php";
  $userId=$_SESSION['id_usuario'];
  $filtro = "WHERE id = '$userId'";
  $profile_id = $_GET['profile_id'];
  if ($profile_id>=0) {
    $filtro = "WHERE id = '$profile_id'";
  }

  $sql = "SELECT * , DATE_FORMAT(nascimento, '%d/%m/%Y') AS nascimento
          FROM pessoa
          $filtro";

  // Executa a query no BD
  $retorno = $con->query($sql);

  // Deu erro no SQL?
  if ($retorno == false) {
    echo $con->error;
  }

  include_once "../topo.php";
  while ($registro = $retorno->fetch_array()) {
    $nome = $registro["nome"];
    $id = $registro["id"];
    $nascimento = $registro["nascimento"];
    $avatar = $registro["avatar"];
    $description = $registro["descricao"];
    $status = $registro["status"];
  }
?>
<br>
<div class="w3-card w3-round w3-white">
  <div class="w3-container">
    <h4 class="w3-center">
      <?php echo($nome);?>
    </h4>
    <p class="w3-center">
      <img src="<?php echo($avatar)?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
    </p>
    <hr>
    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>
      <?php echo $description?>
    </p>
    <p>
      <i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>
      <?php echo $nascimento?>
    </p>
  </div>
</div>

<?php
$timeline_all_posts_sql = "SELECT
                            COUNT(curtida.id_post) as contador_curtidas,
                            COUNT(comentario.id_post) as contador_comentarios,
                            post.id as post_id,
                            post.descricao,
                            post.imagem,
                            pessoa.nome,
                            pessoa.avatar,
                            pessoa.id as profile_id,
                            DATE_FORMAT(post.data_publicacao, '%d/%m/%Y às %H:%i') AS data_publicacao
                          FROM post
                          INNER JOIN pessoa ON pessoa.id = post.id_pessoa
                          left JOIN curtida ON post.id = curtida.id_post
                          left JOIN comentario ON post.id = comentario.id_post
                          WHERE pessoa.id = $id
                          GROUP BY post.id
                          ORDER BY post.id DESC";

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
    include('../components/core/post_block.php');
    $index_post = $index_post + 1;
  }
?>
<?php include_once "../rodape.php"; ?>