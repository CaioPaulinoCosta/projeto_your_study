<?php
  require_once("templates/header.php");

  require_once("dao/LessonDAO.php");

  $lessonDao = new LessonDAO($conn, $BASE_URL);

  $category = $_GET['category'];

// Chamar o método para obter as lições da categoria
$lessons = $lessonDao->getlessonsByCategory($category);
?>

<div id="main-container" class="container">
  <h2 class="section-title">Aulas recentes</h2>
  <p class="section-description">Veja as aulas postadas recentemente</p>
  <div class="lessons-container">
    <?php if (count($lessons) === 0) : ?>
      <p class="empty-list">Ainda não há aulas sobre <?= $category ?> postadas!</p>
    <?php else : ?>
      <?php foreach ($lessons as $lesson) : ?>
        <?php require("templates/lesson_card.php"); ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php
    require_once("templates/footer.php");
  ?>