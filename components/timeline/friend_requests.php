<?php
include "../bd.php";
$userId=$_SESSION["id_usuario"];
$solicitatoes_amizade = "SELECT *, pessoa.id as pessoa_id, amigo.id as amigo_solicitacao_id
        FROM amigo
        INNER JOIN pessoa ON pessoa.id = amigo.id_pessoa
        where amigo.id_pessoa_amigo = $userId and amigo.status=1
        ORDER BY RAND();
";

$amigo_solicitacao_id=$_GET['amigo_solicitacao_id'];
$aceitar_solicitacao_friendId=$_GET['aceitar_solicitacao_friendId'];
if ($aceitar_solicitacao_friendId) {
  $add_friend_query = "INSERT INTO amigo (status, id_pessoa, id_pessoa_amigo)
                  VALUES ('2', $userId, $aceitar_solicitacao_friendId)";
  $con->query($add_friend_query);
  $update_friend_relation_query = "UPDATE amigo SET
    status = '2'
    WHERE id = '$amigo_solicitacao_id';
  ";
  $con->query($update_friend_relation_query);
}

$retorno_solicitatoes_amizade = $con->query($solicitatoes_amizade);
if ($retorno_solicitatoes_amizade == false) {
  echo $retorno_solicitatoes_amizade->error;
}


while ($registro = $retorno_solicitatoes_amizade->fetch_array()) {
  $avatar = $registro['avatar'];
  $nome = $registro['nome'];
  $amigo_solicitacao_id = $registro['amigo_solicitacao_id'];
  $pessoa_id = $registro['pessoa_id'];
  echo("<script>console.log('$nome')</script>");
  echo "
  <div class='w3-card w3-round w3-white w3-center'>
    <div class='w3-container'>
      <p>Quer ser seu amigo</p>
      <img src='$avatar' alt='Avatar' style='width:50%'><br>
      <span>$nome</span>
      <div class='w3-row w3-opacity'>
        <div class='w3-half'>
          <a href='javascript:aceitarSolicitacao($pessoa_id, $amigo_solicitacao_id)' class='w3-button w3-block w3-green w3-section' title='Accept'>
            <i class='fa fa-check'></i>
          </a>
        </div>
        <div class='w3-half'>
          <a class='w3-button w3-block w3-red w3-section' title='Decline'>
            <i class='fa fa-remove'></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  ";
  break;
}
?>
<script>
  function aceitarSolicitacao(friendId, amigo_solicitacao_id) {
    location.href = `timeline.php?aceitar_solicitacao_friendId=${friendId}&amigo_solicitacao_id=${amigo_solicitacao_id}`;
  }
</script>