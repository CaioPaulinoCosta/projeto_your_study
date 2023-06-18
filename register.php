<?php

include_once("templates/header.php");

?>

<div class="container register-container">
  <div class="row m-5 d-flex justify-content-center register">
    <div class="col-lg-6 bg-register p-5">
      <div class="d-flex justify-content-center pb-3"><i class="fa-solid fa-door-open" style="font-size: 70px; color:#260202;"></i></div>
      <h2 class="text-center register-title">Olá!</h2>
      <p class="text-center">Preencha o formulário abaixo com seus dados para fazer registro na página!</p>
      <!-- Formulario de registro -->
      <form action="<?= $BASE_URL ?>auth_process.php" method="POST" class="mt-3 form-register bold">
        <input type="hidden" name="type" value="register">
        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label mt-3">Nome:</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu nome...">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label mt-3">Sobrenome:</label>
              <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Digite seu sobrenome...">
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail...">
          <div class="form-text">Nós não vamos compartilhar seu email com mais ninguém.</div>
        </div>

        <div class="mb-3">
    <label class="form-label">RA:</label>
    <input type="text" class="form-control" name="ra" id="ra"placeholder="Digite seu ra...">
  </div>

  <div class="mb-3">
    <label class="form-label">Senha:</label>
    <input type="password" class="form-control" name="password" id="password"placeholder="Digite sua senha...">
  </div>

  <div class="mb-3">
    <label class="form-label">Confirme sua senha:</label>
    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"placeholder="Confirme sua senha...">
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn" id="btn-register" value="Registrar">Cadastrar</button>
</form >
  </div>
    </div>
  </div>
</div>

<?php

include_once("templates/footer.php");

?>