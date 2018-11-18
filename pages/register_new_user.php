<?php include_once "../topo.php";?>
<h3>Vamos ao cadastro! </h3>
<h5>Faça seu cadastro</h5>
<div class="card">
  <div class="">
    <img style="height: 104px; border-radius: 10%;" src="https://png.pngtree.com/element_origin_min_pic/17/08/16/857317d1b6c1a7115e57e58ddb5e12f4.jpg"/>
  <div>
  <div class="row">
    <form method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="text" class="validate" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s12">
          <input id="senha" name="senha" type="password" class="validate" required>
          <label for="senha">Senha</label>
        </div>
        </div>
        <div class="email-enter">
          <button class="waves-effect waves-light btn btn-small" type="submit">Entrar</button>
        </div>
        <div class="email-enter">
          <a class="waves-effect waves-teal btn-flat btn-small">Cadastrar-se</a>
        </div>
    </form>
  </div>
</div>
<?php include_once "../rodape.php";?>
