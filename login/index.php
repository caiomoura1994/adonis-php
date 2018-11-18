<?php

  // Não exibe msg de notificação
  error_reporting(1);

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    include_once "bd.php";

    // Obtem dados do POST
    $email = addslashes($_POST["email"]);
    $senha = addslashes($_POST["senha"]);

    // Criptografa usando MD5
    // $senha = md5($senha);

    // Cria comando SQL
    $sql = "SELECT * 
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
      session_start();
      // Guarda variáveis na sessão
      $_SESSION["logado"] = true;
      $_SESSION["nome_usuario"] = $registro["nome"];
      $_SESSION["id_usuario"] = $registro["id"];
      echo "
        <script>
          location.href='html_base.html';
        </script>
      ";
    } else {
      echo "
      <script>
        alert('Email ou Senha Inválido!');
      </script>";
    }
  }
  include_once "topo.php"; 
?>

<div id="container">
  <h3 class="text">Bem vindo ao Adonis</h3>
  <h6 class="text">Encontre amigos e compartinhe dados sobre seu pet</h6>
  <div id="login-page" class="row">
    <img src="https://image.flaticon.com/icons/svg/616/616408.svg">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" method="POST">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email" type="email" name="email">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="senha" type="password" name="senha">
            <label for="senha">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input  type="submit" class="btn" value="Login">
          </div>
          <div class="input-field col s12">
            <p class="margin medium-small"><a href="#">Register Now!</a></p>
          </div>      
        </div>
      </form>
    </div>
  </div>
</div>