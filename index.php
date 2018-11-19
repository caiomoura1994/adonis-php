<?php
  // Não exibe msg de notificação
  error_reporting(1);
  session_start();
  if ($_GET['finish_session']) {
    $_SESSION = array();
    session_unset();
    session_destroy();
  }
  
  session_start();
  if ($_SESSION["logado"]) {
    header("Location: pages/timeline.php"); /* Redirect browser */
  }

  // Clicou em enviar?
  if ($_POST != NULL) {
    include_once "bd.php";
    $email = addslashes($_POST["email"]);
    $senha = addslashes($_POST["senha"]);
    // Criptografa usando MD5
    // $senha = md5($senha);

    // Cria comando SQL
    $sql = "SELECT * , DATE_FORMAT(nascimento, '%d/%m/%Y') AS nascimento 
        FROM pessoa 
        WHERE email = '$email' 
        AND senha = '$senha'";
    
    // Executa comando SQL
    $retorno = $con->query($sql);

    // Erro no SQL?
    if ($retorno == false) {
      echo $retorno->error;
    }

    // Obtem registro no banco
    $registro = $retorno->fetch_array();

    // Encontrou usuário?
    if ($registro) {
      // Inicia a sessão
      // Guarda variáveis na sessão
      $_SESSION["logado"] = true;
      $_SESSION["nome_usuario"] = $registro["nome"];
      $_SESSION["id_usuario"] = $registro["id"];
      $_SESSION["avatar_usuario"] = $registro["avatar"];
      $_SESSION["descricao_usuario"] = $registro["descricao"];
      $_SESSION["sexo_usuario"] = $registro["sexo"];
      $_SESSION["nascimento_usuario"] = $registro["nascimento"];
      $_SESSION["email_usuario"] = $registro["email"];
      header("Location: pages/timeline.php"); /* Redirect browser */
    } else {
      echo "
        <script>
          alert('Email ou Senha Inválido!');
        </script>
      ";
    }
  }
  include_once "topo.php"; 
?>
<?php include_once "login/index.php";?>
<?php include_once "rodape.php";?>
