<?php
  include_once('../components/core/navbar.php');
  include_once "../topo.php";
  // error_reporting(1);
  session_start();
  $logado = $_SESSION['logado'];
  if (!$logado) {
    echo("
    <script>
      location.href='/';
    </script>
    ");
  }
  if ($_SESSION["logado"] == NULL) {
      header("Location: /");
  }
  // conecta ao BD
  include_once "../bd.php";
  $userId=$_SESSION['id_usuario'];

  $nomeParam = $_GET['find_name'];
  if ($nomeParam) {
    $filtro = "and nome like '$nomeParam%'";
  }

  $remove_relation = $_GET['remove_relationship'];
  if ($remove_relation) {
    $remove_friend_query = "DELETE FROM amigo WHERE id = $remove_relation";
    $con->query($remove_friend_query);
  }
  
  $facaSolicitacao_friendId=$_GET['facaSolicitacao_friendId'];
  if ($facaSolicitacao_friendId || $facaSolicitacao_friendId==0) {
    $add_friend_query = "INSERT INTO amigo (status, id_pessoa, id_pessoa_amigo)
                    VALUES ('1', $userId, $facaSolicitacao_friendId)";
    $con->query($add_friend_query);
  }
  $sql = "
    SELECT *
    FROM pessoa
    WHERE  pessoa.id <> $userId
    $filtro
  ";

  // Executa a query no BD
  $retorno = $con->query($sql);

  // Deu erro no SQL?
  if ($retorno == false) {
    echo $con->error;
  }
?>

<br>
<h2>Ache seus amigos</h2>

<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="input-field col s8">
        <i class="material-icons prefix">search</i>
        <input
        type="text"
        value="<?php echo $nome;?>"
        id="inputNome"
        class="autocomplete">
        <label for="inputNome">Digite aqui o nome da pessoa que procura ...</label>
      </div>
      <div class="input-field col s4">
        <a
          class="btn btn-info"
          href="javascript:handleFindName();"
        >
          Listar
        </a>
      </div>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped">
	<tr>
		<th>Nome</th>
		<th>Foto</th>
		<th>Sobre</th>
    <th>Seguindo</th>
	</tr>
<?php
    // percorre todos os registros retornados
    if ($retorno) {
      while ($registro = $retorno->fetch_array()) {
        // obtem campos do registro
        $nome = $registro["nome"];
        $friendId = $registro["id"];
        $nascimento = $registro["nascimento"];
        $avatar = $registro["avatar"];
        $description = $registro["descricao"];
        // $status = $registro["status"];

        $friend_query = "SELECT * FROM amigo WHERE id_pessoa=$userId AND id_pessoa_amigo=$friendId;";
        // $friend_query = "SELECT * FROM amigo WHERE id_pessoa=$friendId id_pessoa_amigo=$userId;";

        $amigos = $con->query($friend_query);
        // 1 nao foi solicitado
        $relation_button="
          <a class='btn btn-info' href='javascript:facaSolicitacao($friendId);'>
            <i class='material-icons'>person_add</i>
          </a>
        ";
        while ($amigo = $amigos->fetch_array()) {
          $relation_id = $amigo['id'];
          $relation_status = $amigo['status'];
          // 2 eu solicitei
          if ($amigo['status'] == 1) {
            $relation_button="
              <a class='btn btn-info' href='javascript:removeSolicitacao($relation_id);'>
                <i class='material-icons'>done</i>
              </a>
            ";
          }
          // 3 ele aceitou
          if ($amigo['status'] == 2) {
            $relation_button="
              <a class='btn btn-info' href='javascript:removeSolicitacao($relation_id);'>
                <i class='material-icons'>done_all</i>
              </a>
            ";
          }
        }
  
        echo "<tr>
          <td>$nome</td>
          <td><img src='$avatar' style='height: 56px;' /></td>
          <td>$description</td>
          <td> $relation_button  </td>
        </tr>";
      }
    }
?>
</table>
<script>
  function getFilter() {
    const inputValue = document.getElementById('inputNome').value
    return `find_friends.php?find_name=${inputValue}`;
  }

  function handleFindName() {
    location.href=getFilter();
  }

  function facaSolicitacao(friendId) {
    location.href = `${getFilter()}&facaSolicitacao_friendId=${friendId}`;
  }

  function removeSolicitacao(relation_id) {
    location.href = `${getFilter()}&remove_relationship=${relation_id}`;
  }

</script>

<?php include_once "../rodape.php"; ?>