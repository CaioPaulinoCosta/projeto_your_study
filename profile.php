<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/LessonDAO.php");
require_once("dao/ReviewDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$lessonDao = new LessonDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

// Recebe id do usuario
$id = filter_input(INPUT_GET, "id");

if (empty($id)) {

    if (!empty($userData)) {

        $id = $userData->id;
    } else {

        $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
} else {

    $userData = $userDao->findById($id);

    // Nao encontrou usuario
    if (!$userData) {
        $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
}

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}


// Filmes do professor
$userLesson = $lessonDao->getLessonsByUserId($id);

// Aulas avaliadas do usuario
$reviwedLessons = $reviewDao->getLessonsByReview($userData->id);
?>
<?php if ($userData && $userData->id == "1") : ?>
    <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center profile-section-1">
                            <div class="card m-5" style="width: 18rem;">
                                <div class="profile-image-container">
                                    <div class="img-fluid" id="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center"><?= $fullName ?></h4>
                                    <h6 class="text-center" style="font-size: 12px;"><i class="fa-solid fa-chalkboard-user"></i> Professor</h6>
                                    <textarea class="card-text form-control"><?= $userData->bio ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12 profile-section-2">
                        <h4 class="text-center p-3">Aulas de <?= $fullName ?></h4>
                    </div>
                    <div class="row">
                        <div class="lessons-container">
                            <?php foreach ($userLesson as $lesson) : ?>
                                <div class="card m-4" style="width: 22rem;">
                                    <a href="<?= $BASE_URL ?>video_lesson.php?id=<?= $lesson->id ?>">
                                        <div class="profile-card" style="background-image: url('<?= $BASE_URL ?>img/lessons/<?= $lesson->image ?>')"></div>
                                    </a>
                                    <div class="card-body">
                                        <h6 class="bold"><?= $lesson->title ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><i class="fa-solid fa-star" style="color: #e59819;"></i><span> Avaliado com nota: <?= $lesson->rating ?></span></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
        <?php elseif ($userData) : ?>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center profile-section-1">
                            <div class="card m-5" style="width: 18rem;">
                                <div class="profile-image-container">
                                    <div class="img-fluid" id="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>');"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center"><?= $fullName ?></h4>
                                    <h6 class="text-center" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap"></i> Aluno(a)</h6>
                                    <textarea class="card-text form-control"><?= $userData->bio ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 profile-section-2">
                        <h4 class="text-center p-3">Aulas que <?= $fullName ?> avaliou:</h4>
                    </div>
                    <div class="row">
                        <div class="lessons-container">
                            <?php foreach ($reviwedLessons as $lesson) : ?>
                                <div class="card m-4" style="width: 22rem;">
                                    <a href="<?= $BASE_URL ?>video_lesson.php?id=<?= $lesson->id ?>">
                                        <div class="profile-card" style="background-image: url('<?= $BASE_URL ?>img/lessons/<?= $lesson->image ?>')"></div>
                                    </a>
                                    <div class="card-body">
                                        <h6 class="bold"><?= $lesson->title ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><i class="fa-solid fa-star" style="color: #e59819;"></i><span> Avaliado com nota: <?= $lesson->rating ?></span></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if (count($reviwedLessons) === 0) : ?>
                                <p class="empty-list p-5">Você ainda não avaliou nenhuma aula</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
    
    <?php
    require_once("templates/footer.php");
    ?>