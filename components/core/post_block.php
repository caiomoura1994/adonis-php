<?php
if (!$disable_comments){
  $comentar_button="<a href='/pages/comments.php?post_id=$id_post' type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'></i>  Comentar</a>";
}
echo (
  "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
    <a href='/pages/profile.php?profile_id=$profile_id'>
      <img src='$avatar' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
    </a>
    <span class='w3-right w3-opacity'>$data_publicacao</span>
    <a href='/pages/profile.php?profile_id=$profile_id'>
      <h4>$nome</h4>
    </a>
    <hr class='w3-clear'>
    <img src='$imagem' style='width:100%' class='w3-margin-bottom'>
    <p>$descricao</p>
    <a href='javascript:curtir($id_post);' type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up'></i>  Curtir</a> 
    $comentar_button
  </div>
  "
);
?>