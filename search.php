<?php
  require_once("templates/header.php");

  require_once("dao/LessonDAO.php");

  // DAO dos filmes
  $lessonDao = new LessonDAO($conn, $BASE_URL);

  // Resgata busca do usuário
  $q = filter_input(INPUT_GET, "q");

  $lessons = $lessonDao->findByTitle($q);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
    <div class="movies-container">
      <?php foreach($lessons as $lesson): ?>
        <?php require("templates/lesson_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($lessons) === 0): ?>
        <p class="empty-list">Não há aulas para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>