<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 m-5">
      <h2 class="ps-3 new-lesson-title">Adicionar video aula</h2>
      <p>Preencha o formulário abaixo para adicionar uma vídeo aula para seus alunos cadastrados na página!<br>
        <span style="font-size: 13px;">*Atenção! É preciso ao menos adicionar um título, descrição e uma categoria para a inserção da video aula.*</span>
      </p>
      <form action="<?= $BASE_URL ?>lesson_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data" class="bold">
        <input type="hidden" name="type" value="create">
        <div class="row">
          <!-- Form New Lesson -->
          <div class="col-lg-8">
            <div class="form-group">
              <div class="w-50">
                <h4><label for="title">Título</label></h4>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título da video aula...">
              </div>
              <div class="form-group mt-4">
                <h4><label for="image">Imagem</label></h4>
                <input type="file" class="form-control-file" id="lessonImage" name="image">
              </div>
              <div class="w-50">
                <div class="form-group mt-4">
                  <h4 ><label for="length">Duração</label></h4>
                  <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração da video aula...">
                </div>
                <div class="form-group mt-4">
                  <h4><label for="category">Category:</label></h4>
                  <select name="category" id="category" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Java">Java</option>
                    <option value="PHP">PHP</option>
                    <option value="Javascript">Javascript</option>
                    <option value="Flutter">Flutter</option>
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                  </select>
                  <div class="form-group mt-4">
                    <h4><label for="video">Video</label></h4>
                    <input type="text" class="form-control" id="video" name="video" placeholder="Insira o link da video aula...">
                  </div>

                  <div class="form-group mt-4">
                    <h4><label for="description">Descrição:</label></h4>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Coloque uma breve descrição da aula... "></textarea>
                  </div>

                  <div class="form-group mt-4">
                    <h4><label for="content">Conteudo:</label></h4>
                    <textarea name="content" id="content" rows="5" class="form-control" placeholder="Coloque uma breve descrição da aula... "></textarea>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" class="btn mt-4" id="btn-new-lesson" value="Adicionar Aula">
          </div>
          <div class="col-lg-4">
            <img id="image-preview" src="img/lesson_cover.jpg" alt="Preview da Imagem" style=" max-width: 100%;">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>