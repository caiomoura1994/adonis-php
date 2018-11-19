<?php
  if ($_POST != NULL) {
    include_once "../bd.php";
    $nome = addslashes($_POST["nome"]);
    $raca = addslashes($_POST["raca"]);
    $foto = addslashes($_POST["foto"]);
    $descricao = addslashes($_POST["descricao"]);
    $quer_cruzar = $_POST["quer_cruzar"];
    session_start();
    $userId = $_SESSION["id_usuario"];

    $sql_insert = "INSERT INTO pets
      (`quer_cruzar`, `nome`, `id_pessoa`, `descricao`, `avatar`)
      VALUES ('$quer_cruzar', '$nome', '$userId', '$descricao', '$foto');
    ";
    $con->query($sql_insert);

    echo "
    <script>
      alert('Pet cadastrado com sucesso');
    </script>
    ";
  
  }
  include_once('../components/core/navbar.php');
  include_once "../topo.php";
?>
<h5 style="padding-top:50px;">Cadastro do Pet</h5>
<div style="
      position: absolute;
      left: 50%;
      top: 50%;
      -moz-transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);">

  <div class="row">
    <form method="post" action="/pages/register_new_pet.php" class="col s12">
      <div class="row">
          <div class="input-field col s12">
            <input id="nome" name="nome" type="text" class="validate" required>
            <label for="nome">Nome</label>
          </div>
          <div class="input-field col s12">
            <input id="foto" name="foto" type="text" class="validate" required>
            <label for="foto">Foto</label>
          </div>
          <div class="input-field col s12">
            <input id="descricao" name="descricao" type="text" class="validate" required>
            <label for="descricao">Dados do animal</label>
          </div>
          <div class="input-field col s12">
            <input id="raca" name="raca" type="text" class="validate" required>
            <label for="raca">Raça</label>
          </div>
          <div class="input-field col s12 switch" style="margin-bottom:4rem;" >
            <label>
              Não quero cruzar
              <input value='1' id="quer_cruzar" name="quer_cruzar" type="checkbox">
              <span class="lever"></span>
              Quero cruzar
            </label>
          </div>
        </div>

        <div class="email-enter">
          <button class="waves-effect waves-light btn btn-small" type="submit">Confirmar</button>
        </div>
    </form>
  </div>
</div>
<?php include_once "../rodape.php";?>
