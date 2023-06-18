<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $flassMessage = $message->getMessage();

  if(!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
  }

  $userDao = new UserDAO($conn, $BASE_URL);

  $userData = $userDao->verifyToken(false);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourStudy!</title>
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>

<body>
<header>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $BASE_URL ?>"><img src="img/logo.svg" alt="Bootstrap" width="32">    YourStudy!</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php if ($userData && $userData->id == "1") : ?>
            <?php if ($userData->image == "") {
                $userData->image = "user.jpg";
            }
            ?>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link pt-3" href="<?= $BASE_URL ?>"><i class="fa-solid fa-house"></i>   Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pt-3" href="<?= $BASE_URL ?>new_lesson.php"><i class="fa-solid fa-cloud-arrow-up"></i> Adicionar Aula</a>
        </li>
        <li class="nav-item">
        <a class="nav-link pt-3" href="<?= $BASE_URL ?>dashboard.php"><i class="fa-solid fa-folder"></i> Minhas Aulas</a>
        </li>
        <li class="nav-item dropdown">
  <div class="position-relative">
    <a class="nav-link dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <div class="navbar-profile" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');"></div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="<?= $BASE_URL ?>profile.php"><i class="fa-solid fa-eye"></i>  Ver perfil</a></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>edit_profile.php"><i class="fa-solid fa-user-pen"></i>  Editar perfil</a></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>manage_students.php"><i class="fa-solid fa-hammer"></i>  Gerenciar Alunos</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>logout.php"><i class="fa-solid fa-right-from-bracket"></i>  Sair</a></li>
    </ul>
  </div>
</li>


      </ul>
      <form action="search.php" method="GET" class="d-flex pe-5" role="search">
  <div class="input-group">
    <input type="text" name="q" class="form-control" type="search" placeholder="Buscar aulas..." aria-label="Search">
    <button class="btn btn-light" type="submit">
      <i class="fas fa-search" style="color: #260202;"></i>
    </button>
  </div>
</form>
<?php elseif ($userData) : ?>
            <?php if ($userData->image == "") {
                $userData->image = "user.jpg";
            }
            ?>
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link pt-3" href="<?= $BASE_URL ?>"><i class="fa-solid fa-house"></i>   Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle pt-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-list"></i>  Categorias
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=java">Java</a></li>
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=php">PHP</a></li>
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=javascript">Javascript</a></li>
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=flutter">Flutter</a></li>
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=html">HTML</a></li>
          <li><a class="dropdown-item" href="<?= $BASE_URL ?>category.php?category=css">CSS</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
  <div class="position-relative">
    <a class="nav-link dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <div class="navbar-profile" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');"></div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="<?= $BASE_URL ?>profile.php"><i class="fa-solid fa-eye"></i>  Ver perfil</a></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>edit_profile.php"><i class="fa-solid fa-user-pen"></i>  Editar perfil</a></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>student_hub.php"><i class="fa-sharp fa-solid fa-user-graduate"></i>   Área do aluno</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?= $BASE_URL ?>logout.php"><i class="fa-solid fa-right-from-bracket"></i>  Sair</a></li>
    </ul>
  </div>
</li>

      </ul>
      <form action="search.php" method="GET" class="d-flex pe-5" role="search">
  <div class="input-group">
    <input type="text" name="q" class="form-control" type="search" placeholder="Buscar aulas..." aria-label="Search">
    <button class="btn btn-light" type="submit">
      <i class="fas fa-search" style="color: #260202;"></i>
    </button>
  </div>
</form>
    <?php else : ?>
  </div>
  <ul class="nav navbar-nav justify-content-end pe-5">
  <li class="nav-item">
  <a class="nav-link pt-3" href="<?= $BASE_URL ?>login.php"><i class="fa-sharp fa-solid fa-right-to-bracket"></i>   Login</a>
  </li>
</ul>
<?php endif; ?>
</nav>
</header>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>