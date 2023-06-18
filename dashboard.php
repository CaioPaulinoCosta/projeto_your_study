<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/LessonDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$lessonDao = new LessonDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$userLessons = $lessonDao->getLessonsByUserId($userData->id);

?>


<div id="main-container" class="container-fluid">
  <h2 class="section-title">Aulas postadas</h2>
  <p class="section-description">Atualize as aulas que você já enviou!</p>

  <div class="row d-flex justify-content-center">
    <div class="col-lg-1 bg-dashboard-table m-1">
      <h4 class="text-center m-2">#</h4>
    </div>
    <div class="col-lg-6 bg-dashboard-table m-1">
      <h4 class="text-center m-2">Título</h4>
    </div>
    <div class="col-lg-2 bg-dashboard-table m-1">
      <h4 class="text-center m-2">Categoria</h4>
    </div>
    <div class="col-lg-2 bg-dashboard-table m-1">
      <h4 class="text-center m-2">Ações </h4>
    </div>
  </div>
  <?php foreach ($userLessons as $lesson) : ?>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-1 bg-dashboard-table m-1 dashboard-id">
        <h6 class="text-center m-2 bold"><?= $lesson->id ?></h6>
      </div>
      <div class="col-lg-6 bg-dashboard-table m-1 me-1 dashboard-title">
        <h6 class="m-2"><a href="<?= $BASE_URL ?>lesson.php?id=<?= $lesson->id ?>" id="lesson-title"><?= $lesson->title ?></a></h6>
      </div>
      <div class="col-lg-2 bg-dashboard-table m-1 me-1 dashboard-category">
        <h6 class="text-center m-2"><?= $lesson->category ?></h6>
      </div>
      <div class="col-lg-2 bg-dashboard-table m-1 me-1 d-flex justify-content-center dashboard-actions">
        <div class="row m-2 d-flex justify-content-center">
          <div class="col-lg-4"><a type="button" class="btn btn-sm" id="dashboard-edit-btn" href="<?= $BASE_URL ?>edit_lesson.php?id=<?= $lesson->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
          </div>
          <div class="col-lg-4">
          <form action="<?= $BASE_URL ?>lesson_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $lesson->id ?>">  
          <button type="submit" class="btn btn-sm" id="dashboard-delete-btn"><i class="fa-solid fa-trash"></i></button>
          </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</div>
<?php
require_once("templates/footer.php");
?>