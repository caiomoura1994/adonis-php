<?php
if (!$disable_comments){
  $comentar_button="
  <a href='/pages/comments.php?post_id=$id_post' class='btn-flat btn-floating'>
    <span>
      <i class='material-icons'>insert_comment</i>
    </span>
  </a>
  <a href='javascript:curtir($id_post, $index_post);' class='btn-flat btn-floating'>
    <span>$contador_comentarios</span>
  </a>
  ";
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
    <div class='Post-actions-container'>
      <div class='Post-actions-left'>
        <a href='javascript:curtir($id_post, $index_post);' class='waves-effect btn-flat btn-floating'>
          <i class='Post-actions-like-icon material-icons'>favorite_border</i>
        </a>
        <a href='javascript:curtir($id_post, $index_post);' class='btn-flat btn-floating Post-actions-counter'>
          $contador_curtidas
        </a>
      </div>
      <div class='Post-actions-right'>
        $comentar_button
      </div>
    </div>
  </div>
  "
);
?>
<style>
  .Post-actions-container {
    display: inline-flex;
    justify-content: space-between;
  }
  .Post-actions-counter {
    color: white;
  }
  .Post-actions-left {
    background-color: #4c6371;
    border-radius: 100px;
    margin: 8px;
  }
  .Post-actions-right {
    background-color: #4c6371;
    border-radius: 100px;
    margin: 8px;
  }
  .Post-actions-right span {
    color: white;
  }
  .Post-actions-left span {
    color: white;
  }
</style>