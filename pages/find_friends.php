<?php
  include_once('../components/core/navbar.php');
  include_once "../topo.php";
  error_reporting(1);
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
  }
  
  $friend_id=$_GET['friendId'];
  if ($friend_id) {
    $add_friend_query = "INSERT INTO amigo ('status', id_pessoa, id_pessoa_amigo)
                    VALUES ('1', $userId, $friend_id)";
  }
  // $sql = "$remove_friend_query
  //         $add_friend_query
  $sql = "SELECT * , DATE_FORMAT(nascimento, '%d/%m/%Y') AS nascimento
          FROM pessoa
          -- LEFT JOIN amigo on pessoa.id = amigo.id_pessoa
          WHERE  pessoa.id <> $userId
          $filtro";

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
        $status = $registro["status"];
  
        $view_friends = $registro["view_friends"];
        if ($view_friends) {
          $icon='check';
        } else {
          $icon='person_add';
        }
  
        // CSS do Status
        if ( $status == "Aberto" ) {
          $css_status = "background-color:#F0F8FF;";
        } else if ( $status == "Em Andamento" ) {
          $css_status = "background-color:orange;";
        } else if ( $status == "Fechado" ) {
          $css_status = "background-color:green;";
        }

        if (!$friendId) {
          $friendId=0;
        }
        if (!$view_friends) {
          $view_friends=false;
        }
  
        // imprime linha em HTML
        echo "<tr>
          <td>$nome</td>
          <td><img src='$avatar' style='height: 56px;' /></td>
          <td>$description</td>
          <td>
            <a class='btn btn-info' href='javascript:handleFriend($friendId, $userId, $view_friends);'>
              <i class='material-icons'>$icon</i>
            </a>
          </td>
        </tr>";
      }
    }
?>
</table>
<script>
  function handleFindName() {
    location.href='find_friends.php?find_name=' + document.getElementById('inputNome').value;
  }
  function handleFriend(friendId, userId, view_friends) {
    var filter='find_friends.php?find_name=' + document.getElementById('inputNome').value;
    if (view_friends) {
      var href = filter+`&remove_relationship=${view_friends}`;
    } else {
      var href = filter+`&friendId=${friendId}`;
    }
    location.href = href;
  }
</script>

<?php include_once "../rodape.php"; ?>