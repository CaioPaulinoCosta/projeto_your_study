<?php

include_once("templates/header.php");

?>
<div class="container login-container">
  <div class="row m-5 d-flex justify-content-center login">
    <div class="col-lg-4 bg-login p-5">
      <div class="d-flex justify-content-center p-3"><img class="img-fluid" src="img/user.png"></div>
      <h2 class="text-center">Bem-vindo(a)!</h2>
      <p class="text-center">Digite suas informações de login para acessar a página!</p>
      <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
        <input type="hidden" name="type" value="login">
        <div class="mb-3  mt-5">
          <label for="email" class="form-label bold">Email:</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail...">
        </div>

        <div class="mb-3 mt-5">
          <label for="exampleInputPassword1" class="form-label bold">Senha:</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha...">
        </div>
        <div class="d-grid gap-2">
        <button type="submit" class="btn mt-2" id="btn-login" value="Entrar">Entrar</button>
        </div>
        <p class="text-center mt-2">Ainda não tem um login? <a style="color: #260202" href="<?= $BASE_URL ?>register.php">Clique aqui<a> para se cadastrar!</p>
      </form>
    </div>
  </div>
</div>

<?php

include_once("templates/footer.php");

?>