<?php

$sql = "SELECT * , DATE_FORMAT(data_comentario, '%d/%m/%Y às %H:%i') AS data_comentario
FROM comentario
INNER JOIN pessoa on pessoa.id = comentario.id_pessoa
where comentario.id_post=76
";

// Executa a query no BD
$retorno = $con->query($sql);

// Deu erro no SQL?
if ($retorno == false) {
echo $con->error;
}

include_once "../topo.php";
while ($registro = $retorno->fetch_array()) {    
  $descricao = $registro['descricao'];
  $id_post = $registro['id'];
  $imagem = $registro['imagem'];
  $data_comentario = $registro['data_comentario'];
  $nome = $registro['nome'];
  $profile_id = $registro['profile_id'];
  $avatar = $registro['avatar'];
  $comentario = $registro['comentario'];

  echo("
  <div class='row'>
    <div class='col s12'>
      <div class='card blue-grey darken-1' style='border-radius: 8px;'>
        <div class='card-content white-text Comment-header'>
          <div>
            <div>
              <a href='/pages/profile.php?profile_id=$profile_id'>
                <img src='$avatar' alt='Avatar' class='w3-circle w3-margin-right' style='width:40px'>
              </a>
            </div>
            <span>$nome</span>
          </div>
          <div>
            <a class='btn Comment-date'>$data_comentario</a>
          </div>
        </div>
        <div class='card-content white-text blue-grey darken-3 Comment-comentario'>
          <p>$comentario</p>
        </div>
      </div>
    </div>
  </div>
  ");
}
?>
<style>
  .Comment-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    line-height: initial;
    border-radius: 16px!important;
  }
  .Comment-date {
    border-radius: 100px;
  }
  .Comment-comentario {
    border-radius: 16px!important;
    width: 70%;
    margin-left: 14%;
  }
  .card .card-content {
    padding: 8px;
    border-radius: 16px;
  }

</style>