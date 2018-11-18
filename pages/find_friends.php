<?php include_once('../components/core/navbar.php'); ?>
<?php
    error_reporting(1);
    session_start();
    if ($_SESSION["logado"] == NULL) {
        header("Location: ../index.php");
    }
    // conecta ao BD
    include_once "../bd.php";

    if ($_GET["status"] == 1) {
        $filtro = "WHERE status = 'Aberto'";
    } else if ($_GET["status"] == 2) {
        $filtro = "WHERE status = 'Em Andamento'";
    } else if ($_GET["status"] == 3) {
        $filtro = "WHERE status = 'Fechado'";
    }

    // Cria comando SQL
    $sql = "SELECT * , DATE_FORMAT(nascimento, '%d/%m/%Y') AS nascimento
            FROM pessoa 
            $filtro";

    // Executa a query no BD
    $retorno = $con->query($sql);

    // Deu erro no SQL?
    if ($retorno == false) {
        echo $con->error;
    }

    include_once "../topo.php";
?>

<h1>Listar Chamados</h1>

<br>
<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">textsms</i>
        <input type="text" id="autocomplete-input" class="autocomplete">
        <label for="autocomplete-input">Autocomplete</label>
      </div>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped">
	<tr>
		<th>Nome</th>
		<th>Foto</th>
		<th>Sobre</th>
    <th style="text-align: center;" colspan="3">Ação</th>
	</tr>
<?php
    // percorre todos os registros retornados
    while ($registro = $retorno->fetch_array()) {

    	// obtem campos do registro
    	$nome = $registro["nome"];
    	$nascimento = $registro["nascimento"];
    	$avatar = $registro["avatar"];
    	$description = $registro["descricao"];
    	$status = $registro["status"];

        // CSS do Status
    	if ( $status == "Aberto" ) {
    		$css_status = "background-color:#F0F8FF;";
    	} else if ( $status == "Em Andamento" ) {
    		$css_status = "background-color:orange;";
    	} else if ( $status == "Fechado" ) {
    		$css_status = "background-color:green;";
    	}

    	// imprime linha em HTML
    	echo "<tr>
				<td>$nome</td>
				<td><img src='$avatar' style='height: 56px;' /></td>
				<td>$description</td>
				<td style='$css_status'>$status</td>
        <td><a class='btn btn-info' href='ver.php?id=$id'><i class='far fa-eye'></i></a></td>
        <td><a class='btn btn-warning' href='editar.php?id=$id'><i class='far fa-edit'></i></a></td>
        <td><a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='apagar.php?id=$id'><i class='far fa-trash-alt'></i></a></td>
			</tr>";
    }
?>
</table>

<?php include_once "../rodape.php"; ?>