<?php
if (!$disable_comments){
  $comentar_button="
  <a href='/pages/comments.php?post_id=$id_post' class='btn-flat btn-floating'>
    <span>
      <i class='material-icons'>insert_comment</i>
    </span>
  </a>
  <a class='btn-flat btn-floating'>
    <span>$contador_comentarios</span>
  </a>
  ";
}
$icon_favorite = 'favorite_border';
$sql_seleciona_se_ja_teve_curtida = "SELECT * 
			FROM curtida
			WHERE id_pessoa = '$userId'
      AND id_post = '$id_post'";
if ( $registro = $con->query($sql_seleciona_se_ja_teve_curtida)->fetch_array() ) {
  $icon_favorite = 'favorite';
}
echo (
  "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
    <a href='/pages/profile.php?profile_id=$profile_id'>
      <img src='$avatar' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:40px'>
    </a>
    <span class='w3-right w3-opacity'>$data_publicacao</span>
    <a href='/pages/profile.php?profile_id=$profile_id'>
      <h4>$nome</h4>
    </a>
    <hr class='w3-clear'>
    <img src='$imagem' style='width:90%;' class='w3-margin-bottom'>
    <p>$descricao</p>
    <div class='Post-actions-container'>
      <div class='Post-actions-left'>
        <a href='javascript:curtir($id_post, $index_post);' class='waves-effect btn-flat btn-floating'>
          <i class='Post-actions-like-icon material-icons'>$icon_favorite</i>
        </a>
        <a
          href='javascript:openModalLikes($id_post);'
          class='btn-flat btn-floating Post-actions-counter
        >
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

// <!-- Modal Structure -->
echo("
<div id='modal' class='modal bottom-sheet'>
  <div class='modal-content'>
    <h4>Quem curtiu essa postagem?</h4>
    <ul>
      <li id='li-curtidas'></li>
    </ul>
  </div>
  <div class='modal-footer'>
    <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>
  </div>
</div>
");
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
    z-index: 0;
    background-color: #4c6371;
    border-radius: 100px;
    margin: 8px;
  }
  .Post-actions-right {
    z-index: 0;
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
    
<script>

  function openModalLikes(id_post) {
    $.ajax({
			method: "POST",
			url: '/actions/curtida.php',
			dataType: 'json',
			data: { acao: "listLikes", postagem: id_post }
		})
		.done(function(result){
      var elementModal = document.getElementById('modal');
      var instance = M.Modal.init(elementModal);
      var liCurtidas = document.getElementById('li-curtidas');
      var list = [];
      for (const key in result) {
        var curtida = result[key];
        list.push(`<li>
          <div class="row">
            <div class="col s12 m12">
              <div class="card-panel">
                <a href='/pages/profile.php?profile_id=${curtida.id}'>
                  <img src='${curtida.avatar}' alt='Avatar' class='w3-circle w3-margin-right' style='width:40px'>
                </a>
                <a href='/pages/profile.php?profile_id=${curtida.id}'>
                  ${curtida['nome']}
                </a>
              </div>
            </div>
          </div>
        </li>`)
      }
      liCurtidas.innerHTML = list.join('');
      instance.open();
		});
  }

	function curtir(id_postagem, index_postagem) {
		$.ajax({
			method: "POST",
			url: '/actions/curtida.php',
			dataType: 'json',
			data: { acao: "like", postagem: id_postagem }
		})
		.done(function(result){
			if (result.status) {
        const post_like_counter = document.getElementsByClassName('Post-actions-counter')[index_postagem];
        const post_liked_icon = document.getElementsByClassName('Post-actions-like-icon')[index_postagem];
        post_like_counter.innerText = result.curtidas_contador;
        if (result.curtido) {
          post_liked_icon.className = `animated bounce ${post_liked_icon.className}`;
          post_liked_icon.innerText = 'favorite';
        } else {
          post_liked_icon.innerText = 'favorite_border';
          post_liked_icon.className = 'Post-actions-like-icon material-icons';
        }
			} else {
				alert(result.msg);
			}
		});
	}
</script>