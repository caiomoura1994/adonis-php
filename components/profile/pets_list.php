<?php
include "../bd.php";
$userId=$_SESSION["id_usuario"];
$sql = "SELECT *
        FROM pets
        where pets.id_pessoa = $userId
        ORDER BY pets.id desc;
";
$retorno = $con->query($sql);
if ($retorno == false) {
  echo $retorno->error;
}
?>
<div class="w3-card w3-round">
  <div class="w3-white">
    <a
      href="/pages/register_new_pet.php"
      class="w3-button w3-block w3-theme-l1 w3-left-align"
    >
      <i class="fa fa-plus fa-fw w3-margin-right"></i> Adicionar animal
    </a>
    <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align">
      <i class="fa fa-users fa-fw w3-margin-right"></i> Meus Animais
    </button>
    <div id="Demo3" class="w3-hide w3-container">
      <div class="w3-row-padding">
        <br>
          <?php
          while ($registro = $retorno->fetch_array()) {
            $avatar = $registro['avatar'];
            echo "
            <div class='w3-half'>
              <img src='$avatar' style='width:100%' class='w3-margin-bottom'>
            </div>
            ";
          }
          ?>
      </div>
    </div>
  </div>      
</div>