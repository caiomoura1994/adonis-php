<?php
  error_reporting(1);
  if ($_POST != NULL) {
    include_once "../bd.php";

    $description = addslashes($_POST["description"]);
    $image = addslashes($_POST["image"]);
    $idUsuario = $_SESSION["id_usuario"];
    // Cria comando SQL
    $sql = "INSERT INTO 
      `post` (`id_pessoa`, `descricao`, `imagem`)
      VALUES ($idUsuario, '$description', '$image');
    ";

    // Executa comando SQL
    $retorno = $con->query($sql);
    // Erro no SQL?
    if ($retorno == false) {
      echo $retorno->error;
    }
  }
?>
<form method="post" class="col s12">
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">
          <h6 class="w3-opacity">O que seu animal aprontou hoje?</h6>
          <div class="input-field col s12">
            <textarea
              placeholder="Escreva aqui ..."
              id="description"
              name="description"
              rows="4"
              cols="50"
              style="width: 90%;"
              required
            ></textarea>
          </div>
          <div class="input-field col s12">
            <input
              id="image"
              name="image"
              type="text"
              class="validate"
              style="width: 90%; margin-bottom:10px"
              placeholder="Coloque aqui a Url da imagem"
            >
          </div>
          <button
            type="submit"
            class="w3-button w3-theme"
          >
            <i class="fa fa-pencil"></i> Postar
          </button> 
        </div>
      </div>
    </div>
  </div>
</form>