<?php
  $host = "localhost";
  $usuario = "root";
  $senha = "pass";
  $base_dados = "rede_social";
  
  $con = new mysqli($host, $usuario, $senha, $base_dados);

  if ($con->connect_error) {
    echo "Erro ao conectar<br>";
  }
?>