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
<style>
.container {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .3s ease;
  background-color: transparent;
}

.container:hover .overlay {
  opacity: 1;
}

.icon {
  color: white;
  font-size: 100px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.fa-user:hover {
  color: #eee;
}
</style>

<div class="w3-card w3-round w3-white">
  <div class="w3-container">
    <h4 class="w3-center">
      <?php echo($_SESSION["nome_usuario"]);?>
    </h4>
    <!-- <p class="w3-center">
      <img src="<?php echo($_SESSION["avatar_usuario"])?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
      <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> 
    </p> -->
    <div class="container">
      <p class="w3-center">
      <img alt="Avatar" src="<?php echo($_SESSION["avatar_usuario"])?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
      <div class="overlay">
        <a href="/pages/edit_profile.php" class="icon" title="User Profile">
          <img alt="Avatar" src="https://ubisafe.org/images/pencil-transparent-1.png" class="w3-circle image" style="opacity: 0.8;height:106px;width:106px" alt="Avatar">  
        </a>
      </div>
      </p>
    </div>
    <hr>
    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> 
    <?php echo $_SESSION["descricao_usuario"]?>
    </p>
    <!-- <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p> -->
    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 
    <?php echo $_SESSION["nascimento_usuario"]?>
    </p>
  </div>
</div>