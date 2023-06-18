<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ReviewDAO.php");
require_once("dao/LessonDAO.php");

$reviewDao = new ReviewDao($conn, $BASE_URL);
$user = new User();

$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$fullName = $user->getFullName($userData);

$reviwedLessons = $reviewDao->getLessonsByReview($userData->id);

$users = $userDao->findAllUsers();

if ($userData->image == "") {
  $userData->image = "user.jpg";
}


?>

<div class="container edit-profile bg-body-tertiary  p-5">
  <?php if ($userData && $userData->id == "1") : ?>
    <div class="row">
      <div class="col text-center m-5 p-3">
        <h4>Edite seu perfil!</h4>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <div class="row">
            <div class="col-lg-6">
              <div class="dashboard-menu-image">
                <div class="img-fluid" id="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>'); position: relative;">
                  <button class="btn btn-editprofile-image" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-sharp fa-solid fa-user-pen" style="position: absolute; bottom: 0; right: 0; font-size: 30px;color: #BFA288;"></i></button>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title fs-5" id="exampleModalLabel">Foto de perfil:</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div id="modal-profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>'); position: relative;"></div>

                    </div>
                    <div class="modal-footer">
                      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="img-update">
                        <input type="file" name="image" id="image">
                        <button type="button" class="btn btn-primary" id="file-button"><label for="image">Alterar</label></button>
                        <input type="submit" class="btn btn-success" value="Salvar alterações">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <h2 id="user-profile-name" class="pt-3"><i style="font-size:18px;" class="fa-solid fa-chalkboard-user"></i> <?= $fullName ?></h2>
              <h6 class="ps-1"> professor</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
              <div class="col-lg-6">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $userData->name ?>">
              </div>
              <div class="col-lg-6">
                <label for="lastname">Sobrenome:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $userData->lastname ?>">
              </div>
            </div>
            <label for="email" class="mt-3">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $userData->email ?>">
            <label for="bio" class="mt-3">Bio:</label>
            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é..."><?= $userData->bio ?></textarea>
            <div class="form-group mt-3">
              <div class="d-grid gap-2 mt-3">
                <input type="submit" class="btn btn-primary" value="Altualizar">
              </div>
          </form>
          <h4 class="mt-3">Altera sua senha:</h4>
          <form action="<?= $BASE_URL ?>user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <div class="form-group mt-3">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
            </div>
            <div class="form-group mt-3">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
              <div class="d-grid gap-2 mt-3">
                <input type="submit" class="btn btn-primary" value="Alterar Senha">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php elseif ($userData) : ?>
    <div class="row">
      <div class="col text-center m-5 p-3">
        <h4>Edite seu perfil!</h4>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <div class="row">
            <div class="col-lg-6">
              <div class="dashboard-menu-image">
                <div class="img-fluid" id="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>'); position: relative;">
                  <button class="btn btn-editprofile-image" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-sharp fa-solid fa-user-pen" style="position: absolute; bottom: 0; right: 0; font-size: 30px;color: #BFA288;"></i></button>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title fs-5" id="exampleModalLabel">Foto de perfil:</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div id="modal-profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>'); position: relative;"></div>

                    </div>
                    <div class="modal-footer">
                      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="img-update">
                        <input type="file" name="image" id="image">
                        <button type="button" class="btn btn-primary" id="file-button"><label for="image">Alterar</label></button>
                        <input type="submit" class="btn btn-success" value="Salvar alterações">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <h2 id="user-profile-name" class="pt-3"><?= $fullName ?></h2>
              <h6 class="ps-1"><i class="fa-solid fa-graduation-cap"></i> Aluno(a)</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
              <div class="col-lg-6">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $userData->name ?>">
              </div>
              <div class="col-lg-6">
                <label for="lastname">Sobrenome:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $userData->lastname ?>">
              </div>
            </div>
            <label for="email" class="mt-3">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $userData->email ?>">
            <label for="bio" class="mt-3">Bio:</label>
            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é..."><?= $userData->bio ?></textarea>
            <label for="ra" class="mt-3">RA:</label>
            <input type="ra" class="form-control" name="ra" id="ra" value="<?= $userData->ra ?>">
            <div class="form-group mt-3">
              <div class="d-grid gap-2 mt-3">
                <input type="submit" class="btn btn-primary" value="Altualizar">
              </div>
          </form>
          <h4 class="mt-3">Altera sua senha:</h4>
          <form action="<?= $BASE_URL ?>user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <div class="form-group mt-3">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
            </div>
            <div class="form-group mt-3">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
              <div class="d-grid gap-2 mt-3">
                <input type="submit" class="btn btn-primary" value="Alterar Senha">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
</div>

<?php
include_once("templates/footer.php");
?>