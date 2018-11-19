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
  if ($profile_id) {
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


<?php include_once "../rodape.php"; ?>