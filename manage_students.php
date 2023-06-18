<?php
require_once("templates/header.php");
require_once("dao/GradeDAO.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);
$gradeDao = new GradeDao($conn, $BASE_URL);

$users = $userDao->findAllUsers();

?>

<div class="container manage_studentes-container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="manage-studentes-title pb-3 mt-5">Alunos cadastrados no site</h2>
            <p class="pt-3 pb-3">Tabela com os registros de todos alunos cadastrados na página.<br>
                Utilizando os botões de ações, é possível atribuir, editar e visualizar as notas de cada aluno cadastrado.
            </p>
            <table class="table" id="contacts-table">
                <thead class="bg-thead table-nav">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">Email</th>
                        <th scope="col">RA</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <?php $id = $user['id']; ?>
                    <?php $usersGrades = $gradeDao->getGradesByUserId($user['id']); ?>
                    <td scope="row" class="col-id"><?php echo $user['id']; ?></td>
                    <td scope="row"><?php echo $user['name']; ?></td>
                    <td scope="row"><?php echo $user['lastname']; ?></td>
                    <td scope="row"><?php echo $user['email']; ?></td>
                    <td scope="row"><?php echo $user['ra']; ?></td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#show-<?php echo $user['id']; ?>"><i class="fas fa-eye check-icon"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#calculator-<?php echo $user['id']; ?>"><i class="fa-solid fa-calculator calculator-icon"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $user['id']; ?>"><i class="fa-solid fa-pen-to-square edit-icon"></i></a>
                        <!-- Modal Show -->
                        <div class="modal fade" id="show-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="show-<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="show-<?php echo $user['id']; ?>">Notas de <?php echo $user['name'] ?> <?php echo $user['lastname'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <?php foreach ($usersGrades as $grade) : ?>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>

                                                    <tr>

                                                        <th scope="col">P1</th>
                                                        <th scope="col">P2</th>
                                                        <th scope="col">P3</th>
                                                        <th scope="col">P4</th>
                                                        <th scope="col">T1</th>
                                                        <th scope="col">T2</th>
                                                        <th scope="col">Média</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td><?= $grade->p1 ?></td>
                                                        <td><?= $grade->p2 ?></td>
                                                        <td><?= $grade->p3 ?></td>
                                                        <td><?= $grade->p4 ?></td>
                                                        <td><?= $grade->t1 ?></td>
                                                        <td><?= $grade->t2 ?></td>
                                                        <td><?= $grade->average ?></td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Calculator-->
                        <div class="modal fade" id="calculator-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="calculator-<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="calculator">Atribuir Notas:</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="create-form" action="<?= $BASE_URL ?>grades_process.php" method="POST">
                                            <input type="hidden" name="type" value="average">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                            <label for="p1">Primeira prova:</label>
                                            <input type="text" class="form-control w-25 p1" name="p1" id="p1">

                                            <label for="p2" class="mt-3">Segunda prova:</label>
                                            <input type="text" class="form-control w-25 p2" name="p2" id="p2">

                                            <label for="p3" class="mt-3">Terceira prova:</label>
                                            <input type="text" class="form-control w-25 p3" name="p3" id="p3">

                                            <label for="p4" class="mt-3">Quarta prova:</label>
                                            <input type="text" class="form-control w-25 p4" name="p4" id="p4">

                                            <label for="t1" class="mt-3">Primeiro Trabalho:</label>
                                            <input type="text" class="form-control w-25 t1" name="t1" id="t1">

                                            <label for="t2" class="mt-3">Segundo trabalho:</label>
                                            <input type="text" class="form-control w-25 t2" name="t2" id="t2">
                                            <input type="submit" class="btn btn-primary mt-3" value="Atribuir notas">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit-->
                        <div class="modal fade" id="edit-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="edit-<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="edit">Editar notas:</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="create-form" action="<?= $BASE_URL ?>grades_process.php" method="POST">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <input type="hidden" name="id" value="<?= $grade->id ?>">

                                            <label for="p1">Primeira prova:</label>
                                            <input type="text" class="form-control w-25 p1" name="p1" id="p1">

                                            <label for="p2" class="mt-3">Segunda prova:</label>
                                            <input type="text" class="form-control w-25 p2" name="p2" id="p2">

                                            <label for="p3" class="mt-3">Terceira prova:</label>
                                            <input type="text" class="form-control w-25 p3" name="p3" id="p3">

                                            <label for="p4" class="mt-3">Quarta prova:</label>
                                            <input type="text" class="form-control w-25 p4" name="p4" id="p4">

                                            <label for="t1" class="mt-3">Primeiro Trabalho:</label>
                                            <input type="text" class="form-control w-25 t1" name="t1" id="t1">

                                            <label for="t2" class="mt-3">Segundo trabalho:</label>
                                            <input type="text" class="form-control w-25 t2" name="t2" id="t2">
                                            <input type="submit" class="btn btn-primary mt-3" value="Editar notas">
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>