<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/LessonDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$lessonDao = new LessonDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {

    $message->setMessage("O filme não foi encontrado!", "error", "index.php");
} else {

    $lesson = $lessonDao->findById($id);

    // Verifica se o filme existe
    if (!$lesson) {

        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    }
}

  // Checar se o filme tem imagem
  if($lesson->image == "") {
    $lesson->image = "lesson_cover.jpg";
  }

  ?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $lesson->title?></h1>
                <p class="page-description">Altere os dados da sua video aula no formulario abaixo!</p>
                <form id="edit-movie-form" action="<?= $BASE_URL ?>lesson_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $lesson->id ?>">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu filme" value="<?= $lesson->title ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="length">Conteudo:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="<?= $lesson->content ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Java" <?= $lesson->category === "Java" ? "selected" : "" ?> >Java</option>
                            <option value="PHP" <?= $lesson->category === "PHP" ? "selected" : "" ?> >PHP</option>
                            <option value="Javascript" <?= $lesson->category === "Javascript" ? "selected" : "" ?> >Javascript</option>
                            <option value="Flutter" <?= $lesson->category === "Flutter" ? "selected" : "" ?> >Flutter</option>
                            <option value="HTML" <?= $lesson->category === "HTML" ? "selected" : "" ?> >HTML</option>
                            <option value="CSS" <?= $lesson->category === "CSS" ? "selected" : "" ?> >CSS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="video">Video:</label>
                        <input type="text" class="form-control" id="video" name="video" placeholder="Insira o link do video" value="<?= $lesson->video ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme..."><?= $lesson->description ?></textarea>
                    </div>
                    <input type="submit" class="btn bg-secondary" value="Editar video aula">
                </form>
            </div>
            <div class="col-md-3">
                <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/videoClasses/<?= $lesson->image ?>')"></div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>