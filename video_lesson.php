<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/Lesson.php");
require_once("dao/LessonDAO.php");
require_once("dao/UserDAO.php");
require_once("dao/ReviewDAO.php");

// Pegar o id do filme
$lessonId = filter_input(INPUT_GET, "id");

$lesson;

$lessonDao = new LessonDAO($conn, $BASE_URL);

$reviewDao = new ReviewDAO($conn, $BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

$userLesson = $userDao->findByLessonId($lessonId);

if (empty($lessonId)) {

  $message->setMessage("O filme não foi encontrado!", "error", "index.php");
} else {

  $lesson = $lessonDao->findById($lessonId);

  // Verifica se o filme existe
  if (!$lesson) {

    $message->setMessage("O filme não foi encontrado!", "error", "index.php");
  }
}

// Checar se o filme tem imagem
if ($lesson->image == "") {
  $lesson->image = "lesson_cover.jpg";
}

// Checar se o filme é do usuário
$userOwnsLesson = false;

if (!empty($userData)) {

  if ($userData->id === $lesson->users_id) {
    $userOwnsLesson = true;
  }

  // Resgatar as reviews do filme
  $alreadyReviewed = $reviewDao->hasAlreadyReviewed($lessonId, $userData->id);
}

// Resgatar as reviews do filme
$lessonReviews = $reviewDao->getLessonReview($lesson->id);

?>
<div class="container pt-5">
  <div class="row">
  <div class="col-lg bg-video m-0 p-0 video-section-1">
    <iframe id="video-lesson" src="<?= $lesson->video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div class="p-2"><h2><?= $lesson->title ?></h2></div>
    <div class="p-2"><h6><i class="fa-solid fa-tag"></i>  Categoria: <?= $lesson->category ?></h6></div>
    <div class="row m-0">
    <?php foreach($userLesson as $user  ): ?>
    <div class="col-lg-12 video-section-2">
    <div class="row">
    <div class="col-lg-1 pt-3">
    <a href="<?= $BASE_URL ?>profile.php?id=<?= $user->id ?>"><div id="review-profile" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $user->image ?>');"></div></a>
    </div>
    <div class="col-lg-11 mt-4">
    <h5><?= $user->name ?> <?= $user->lastname ?></h5>
    <h6 style="font-size: 12px;"><i class="fa-solid fa-chalkboard-user"></i>  Professor</h6>
    </div>
  </div>
    </div>
    <?php endforeach; ?>
    <div class="col-lg-12 pt-3 mt-3 video-section-3">
    <h4>Descrição da aula</h4>
    <p><?= $lesson->description ?></p>
    <p class="more-text" style="display: none;"><?= $lesson->content ?></p>
    <button class="btn btn-see-more" onclick="showMore()">Ver Mais</button>
  </div>
  </div>
</div>
  </div>

  <?php foreach ($lessonReviews as $review) : ?>
    <?php require("templates/user_review.php"); ?>
  <?php endforeach; ?>
  <?php if (count($lessonReviews) == 0) : ?>
    <p class="empty-list">Não há comentários para este filme ainda...</p>
  <?php endif; ?>

  <?php if (!empty($userData) && !$userOwnsLesson && !$alreadyReviewed) : ?>
    <div class="col-md-5" id="review-form-container">
      <h4>Envie sua avaliação:</h4>
      <p>Preencha o formulário com a nota e comentário sobre a video aula!</p>
      <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
        <input type="hidden" name="type" value="create">
        <input type="hidden" name="lessons_id" value="<?= $lesson->id ?>">
        <div class="form-group">
          <label for="rating" class="pb-2">Nota para a aula:</label>
          <select name="rating" id="rating" class="form-control">
            <option value="">Selecione</option>
            <option value="10">10</option>
            <option value="9">9</option>
            <option value="8">8</option>
            <option value="7">7</option>
            <option value="6">6</option>
            <option value="5">5</option>
            <option value="4">4</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
          </select>
        </div>
        <div class="form-group">
          <label for="review" class="pb-2">Seu comentário:</label>
          <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou da aula?"></textarea>
        </div>
        <input type="submit" class="btn btn-secondary mt-2" value="Enviar comentário">
      </form>
    </div>
  <?php endif; ?>
</div>
</div>
<?php
require_once("templates/footer.php");
?>