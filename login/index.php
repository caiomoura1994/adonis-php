
<div id="container">
  <h3 class="text">Bem vindo ao Adonis</h3>
  <h6 class="text">Encontre amigos e compartinhe dados sobre seu pet</h6>
  <div id="login-page" class="row">
    <img style="height: 104px;" src="https://image.flaticon.com/icons/svg/616/616408.svg"/>
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" method="POST">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email" type="email" name="email" required>
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="senha" type="password" name="senha" required>
            <label for="senha">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <input  type="submit" class="btn" value="Entrar">
          </div>
          <div class="col s12">
            <p class="margin medium-small">
              <a class="waves-effect waves-teal btn-flat btn-small" href="/pages/register_new_user.php">Cadastrar-se</a>
            </p>
          </div>      
        </div>
      </form>
    </div>
  </div>
</div>