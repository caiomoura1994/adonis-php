<?php
  if ($_POST != NULL) {
    include_once "../bd.php";
    $email = addslashes($_POST["email"]);
    $nome = addslashes($_POST["nome"]);
    $senha = addslashes($_POST["senha"]);
    // $sexo = addslashes($_POST["sexo"]);
    function insertNewUser() {
      $sql_insert = "INSERT * 
        FROM pessoa
        WHERE email = '$email'
        INSERT INTO `pessoa` (`nome`, `email`, `senha`, `sexo`, `nascimento`)
        VALUES ('$nome', '$email', '$senha', '1', '2014-01-01');
      ";
      $con->query($sql_insert);

    } 

    $sql = "SELECT *
      FROM pessoa
      WHERE email = '$email'
    ";
    
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
      echo "
        <script>
          alert('Já existe usuário cadastrado com esse email!');
        </script>
      ";
    } else {
      insertNewUser();
      echo "
      <script>
        alert('Voce foi cadastrado com sucesso, faça login para continuar');
        location.href = '/';
      </script>
      ";
    }
  }
  include_once "../topo.php";
?>

<h3>Vamos ao cadastro! </h3>
<h5>Faça seu cadastro</h5>
<div style="position: absolute;
      left: 50%;
      top: 50%;
      -moz-transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);">
  <!-- <div class="">
    <img style="height: 104px; border-radius: 10%;" src="https://png.pngtree.com/element_origin_min_pic/17/08/16/857317d1b6c1a7115e57e58ddb5e12f4.jpg"/>
  <div> -->
  <div class="row">
    <form method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="nome" name="nome" type="text" class="validate" required>
          <label for="nome">Nome</label>
        </div>
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
          <button class="waves-effect waves-light btn btn-small" type="submit">Confirmar</button>
        </div>
    </form>
  </div>
</div>
<?php include_once "../rodape.php";?>
