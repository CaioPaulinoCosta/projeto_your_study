<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/GradeDAO.php");
require_once("dao/UserDAO.php");

$user = new User();
$gradeDao = new GradeDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);


$userData = $userDao->verifyToken(true);

$userGrades = $gradeDao->getGradesByUserId($userData->id);

?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-5 ms-5 mb-3">
            <h2>Bem-vindo(a) a área do aluno!</h2>
            <p>Aqui você pode visualizar as notas atribuídas para suas provas e trabalhos realizados.</p>
        </div>
        <?php foreach ($userGrades as $grade) : ?>
        <div class="col-lg-12 mb-5 ms-5">
            <h4 class="bg-custom p-1">Notas de provas</h4>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 text-center m-2">
                <img class="img-fluid" src="img/test-aprove.png" width="64px">
                <h5 class="mt-3">Nota da primeira prova</h5>
                <h2 class="text-center p-3"><?= $grade->p1 ?></h2>
            </div>
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/test-aprove.png" width="64px">
                <h5 class="mt-3">Nota da segunda prova</h5>
                <h2 class="text-center p-3"><?= $grade->p2 ?></h2>
            </div>
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/test-aprove.png" width="64px">
                <h5 class="mt-3">Nota da terceira prova</h5>
                <h2 class="text-center p-3"><?= $grade->p3 ?></h2>
            </div>
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/test-aprove.png" width="64px">
                <h5 class="mt-3">Nota da quarta prova</h5>
                <h2 class="text-center p-3"><?= $grade->p4 ?></h2>
            </div>
        </div>

        <div class="col-lg-12 mb-5 ms-5">
            <h4 class="bg-custom p-1">Notas de trabalhos</h4>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 text-center m-2">
                <img class="img-fluid" src="img/clipboard.png" width="64px">
                <h5 class="mt-3">Nota do primeiro trabalho</h5>
                <h2 class="text-center p-3"><?= $grade->t1 ?></h2>
            </div>
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/clipboard.png" width="64px">
                <h5 class="mt-3">Nota do segundo trabalho</h5>
                <h2 class="text-center p-3"><?= $grade->t2 ?></h2>
            </div>
        </div>

        <?php if ($grade->average > 6) : ?>
        <div class="col-lg-12 mb-5 ms-5">
            <h4 class="bg-custom p-1">Parabéns! Você está acima da média necessária! <i class="fa-solid fa-face-laugh-wink"></i></h4>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/imgProva.png" width="64px">
                <h5 class="mt-3">Nota da sua média final</h5>
                <h2 class="text-center p-3"><?= $grade->average ?></h2>
            </div>
        </div>
        <?php else: ?>
        <div class="col-lg-12 mb-5 ms-5">
            <h4 class="bg-custom p-1">Infelizmente você está abaixo da média. <i class="fa-solid fa-face-sad-tear"></i></h4>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 text-center m-2">
            <img class="img-fluid" src="img/test-fail.png" width="64px">
                <h5 class="mt-3">Nota da sua média final</h5>
                <h2 class="text-center p-3"><?= $grade->average ?></h2>
            </div>
        </div>
        <?php endif ?>
        <?php endforeach; ?>
    </div>
</div>


<?php
require_once("templates/footer.php");
?>