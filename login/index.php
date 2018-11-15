<?php

  // Não exibe msg de notificação
  error_reporting(1);

  // Clicou em enviar?
  if ($_POST != NULL) {

    // Conecta ao BD
    include_once "../bd.php";

    // Obtem dados do POST
    $login = addslashes($_POST["login"]);
    $senha = addslashes($_POST["senha"]);

    // Criptografa usando MD5
    $senha = md5($senha);

    // Cria comando SQL
    $sql = "SELECT * 
        FROM usuario 
        WHERE login = '$login' 
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
      // Redireciona para a página principal
      header("Location: chamado/listar.php");
    } else {
      echo "<script>
          alert('Login ou Senha Inválido!');
          </script>";
    }
  }
  include_once "../topo.php"; 
?>
  <h3> Vamos começar agora! </h3>
  <h4> Bem vindo a nossa rede social top!</h4>
  <div class="card">
    <div class="">
      <img style="height: 104px;" src="http://krmangalam.edu.in/wp-content/uploads/2018/02/Student-login-icon.png"/>
    <div>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <input id="email" name="login" type="text" class="validate" required>
            <label for="email">Email</label>
          </div>
          <div class="input-field col s12">
            <input id="senha" name="senha" type="text" class="validate">
            <label for="senha">Senha</label>
          </div>
          </div>
          <div class="Login-enter">
            <a class="waves-effect waves-light btn btn-small">Entrar</a>
          </div>
          <div class="Login-enter">
            <a class="waves-effect waves-teal btn-flat btn-small">Cadastrar-se</a>
          </div>
      </form>
    </div>
  </div>
<?php include_once "../rodape.php";?>
