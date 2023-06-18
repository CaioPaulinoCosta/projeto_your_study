<?php
  require_once("templates/header.php");

  require_once("dao/LessonDAO.php");

  // DAO dos filmes
  $lessonDao = new LessonDAO($conn, $BASE_URL);

  $latestLessons = $lessonDao->getLatestLessons();

?>
  <div id="main-container" class="container">
    <h2 class="section-title">Aulas recentes</h2>
    <p class="section-description">Veja as aulas postadas recentemente</p>
    <div class="lessons-container">
      <?php foreach($latestLessons as $lesson): ?>
        <?php require("templates/lesson_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($latestLessons) === 0): ?>
        <p class="empty-list">Ainda não há aulas postadas!</p>
      <?php endif; ?>
    </div>
  </div>

  <?php
        require_once("templates/footer.php");
  ?>