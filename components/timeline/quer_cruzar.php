<?php
include "../bd.php";
$userId=$_SESSION["id_usuario"];
$quer_cruzar_sql = "SELECT *
        FROM pets
        where pets.id_pessoa <> $userId and pets.quer_cruzar=1
        ORDER BY pets.id desc;
";
$retorno = $con->query($quer_cruzar_sql);
if ($retorno == false) {
  echo $retorno->error;
}

while ($registro = $retorno->fetch_array()) {
  $avatar = $registro['avatar'];
  $nome = $registro['nome'];
  $descricao = $registro['descricao'];
  echo "
  <div class='w3-card w3-round w3-white w3-center'>
  <div class='w3-container'>
    <p>Quer cruzar?</p>
    <img src='$avatar' alt='Forest' style='width:100%;'>
    <p><strong>$nome</strong></p>
    <p>$descricao</p>
    <p><a href='javascript:alert(`$nome recebeu sua solicitação para cruzar`);' class='w3-button w3-block w3-theme-l4'>Partiu Cruzar</a></p>
  </div>
  </div>
  ";
}

?>