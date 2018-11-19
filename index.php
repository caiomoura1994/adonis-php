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
      session_start();
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
<h3> Vamos começar agora! </h3>
<h4> Bem vindo a nossa rede social top!</h4>
<div class="card">
  <div class="">
    <img style="height: 104px;" src="http://krmangalam.edu.in/wp-content/uploads/2018/02/Student-login-icon.png"/>
  <div>
  <div class="row">
    <form method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="text" class="validate" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s12">
          <input id="senha" name="senha" type="password" class="validate" required>
          <label for="senha">Senha</label>
        </div>
        </div>
        <div class="email-enter">
          <button class="waves-effect waves-light btn btn-small" type="submit">Entrar</button>
        </div>
        <div class="email-enter">
          <a class="waves-effect waves-teal btn-flat btn-small">Cadastrar-se</a>
        </div>
    </form>
  </div>
</div>
<?php include_once "rodape.php";?>
