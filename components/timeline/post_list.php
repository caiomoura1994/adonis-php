<?php
include_once "../bd.php";
$sql = 'SELECT 
          post.descricao,
          post.imagem,
          post.data_publicacao,
          pessoa.nome,
          pessoa.avatar
        FROM post
        INNER JOIN pessoa
        ON post.id_pessoa = pessoa.id
        ORDER BY post.id desc;
';
// Executa comando SQL
$retorno = $con->query($sql);

// Erro no SQL?
if ($retorno == false) {
  echo $retorno->error;
}

// Obtem registro no banco
while ($registro = $retorno->fetch_array()) {

  // // obtem campos do registro
  $descricao = $registro['descricao'];
  $imagem = $registro['imagem'];
  $data_publicacao = $registro['data_publicacao'];
  $nome = $registro['nome'];
  $avatar = $registro['avatar'];
  // $data_publicacao->format('Y-m-d H:i:s');

  // imprime linha em HTML
  echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
  <img src='$avatar' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
  <span class='w3-right w3-opacity'>$data_publicacao</span>
  <h4>$nome</h4><br>
  <hr class='w3-clear'>
  <img src='$imagem' style='width:100%' class='w3-margin-bottom'>
  <p>$descricao</p>
  <button type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up'></i>  Like</button> 
  <button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comment</button> 
</div>";
}
?>