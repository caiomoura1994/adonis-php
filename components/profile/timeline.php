<!-- 
  $_SESSION["logado"] = true;
  $_SESSION["nome_usuario"] = $registro["nome"];
  $_SESSION["id_usuario"] = $registro["id"];
  $_SESSION["avatar_usuario"] = $registro["avatar"];
  $_SESSION["descricao_usuario"] = $registro["descricao"];
  $_SESSION["sexo_usuario"] = $registro["sexo"];
  $_SESSION["nascimento_usuario"] = $registro["nascimento"];
  $_SESSION["email_usuario"] = $registro["email"];
-->
<div class="w3-card w3-round w3-white">
  <div class="w3-container">
    <h4 class="w3-center">
      <?php echo($_SESSION["nome_usuario"]);?>
    </h4>
    <p class="w3-center">
      <img src="<?php echo($_SESSION["avatar_usuario"])?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
    </p>
    <hr>
    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
  </div>
</div>