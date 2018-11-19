<?php
  include_once('../components/core/navbar.php');
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
  // conecta ao BD
  include_once "../bd.php";
  $userId=$_SESSION['id_usuario'];
  $filtro = "WHERE id = '$userId'";
  $profile_id = $_GET['profile_id'];
  if ($profile_id) {
    $filtro = "WHERE id = '$profile_id'";
  }

  $sql = "SELECT *
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
    $descricao = $registro["descricao"];
    $status = $registro["status"];
  }

  if ($_POST != NULL) {
    $avatar = addslashes($_POST["avatar"]);
    $nome = addslashes($_POST["nome"]);
    $nascimento = addslashes($_POST["nascimento"]);
    $descricao = addslashes($_POST["descricao"]);
    // Cria comando SQL
    $sql = "UPDATE pessoa SET
    nome = '$nome',
    avatar = '$avatar',
    descricao = '$descricao',
    nascimento = '$nascimento'
    WHERE id = '$userId';";
    
    // Executa comando SQL
    $retorno = $con->query($sql);

    // Erro no SQL?
    if ($retorno == false) {
      echo $retorno->error;
    }

    // Encontrou usuário?
    session_start();
    // Guarda variáveis na sessão
    $_SESSION["logado"] = true;
    $_SESSION["nome_usuario"] = $nome;
    $_SESSION["avatar_usuario"] = $avatar;
    $_SESSION["descricao_usuario"] = $descricao;
    $_SESSION["nascimento_usuario"] = $nascimento;
    header("Location: pages/edit_profile.php"); /* Redirect browser */
  }
?>
<br>

<div class="w3-card w3-round w3-white" style="margin: 5em;">
  <div class="w3-container">
    <h4 class="w3-center">
      <?php echo($nome);?>
    </h4>
    <div class="row">
      <form method="post" action="edit_profile.php" class="col s12">
        <div class="row">
        <p class="w3-center">
          <div class="input-field col s12">
            <i class="material-icons prefix">insert_photo</i>
            <input id="avatar" name="avatar" type="text" class="validate" value="<?php echo($avatar)?>">
            <label for="avatar">Foto</label>
          </div>
        </p>
        <p class="w3-center">
          <div class="input-field col s12">
            <i class="material-icons prefix">person</i>
            <input id="nome" name="nome" type="text" class="validate" value="<?php echo $nome?>">
            <label for="nome">Nome</label>
          </div>
        </p>
        <p class="w3-center">
          <div class="input-field col s12">
            <i class="material-icons prefix">person</i>
            <input id="nascimento" name="nascimento" type="date" class="validate" value="<?php echo $nascimento?>">
            <label for="nascimento">Nascimento</label>
          </div>
        </p>
        <p class="w3-center">
          <div class="input-field col s12">
            <i class="material-icons prefix">edit</i>
            <input id="descricao" name="descricao" type="text" class="validate" value="<?php echo $descricao?>">
            <label for="descricao">Descrição</label>
          </div>
        </p>
        </div>
        <div class="col s12">
          <input type="submit" class="btn" value="Entrar">
        </div>
      </form>
    </div>
  </div>
</div>


<?php include_once "../rodape.php"; ?>