<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Lesson.php");
require_once("models/Message.php");
require_once("models/Review.php");
require_once("dao/UserDAO.php");
require_once("dao/LessonDAO.php");
require_once("dao/ReviewDAO.php");

//Recebe o tipo do formulario

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$lessonDao = new LessonDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

// Recebe o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if ($type === "create") {

    // Recebe dados do post
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $lessons_id = filter_input(INPUT_POST, "lessons_id");
    $users_id = $userData->id;

    $reviewObject = new Review();

    $lessonData = $lessonDao->findById($lessons_id);

    // Valida se o filme existe
    if ($lessonData) {

        // Verificar dados minimos
        if (!empty($rating) && !empty($review) && !empty($lessons_id)) {

            $reviewObject->rating = $rating;
            $reviewObject->review = $review;
            $reviewObject->lessons_id= $lessons_id;
            $reviewObject->users_id = $users_id;

            $reviewDao->create($reviewObject);

        } else {
            $message->setMessage("Você precisa inserir a nota e o comentário!", "error", "back");
        }
    } else {

        $message->setMessage("Informações inválidas!", "error", "index.php  ");
    }
} else {

    $message->setMessage("Informações inválidas!", "error", "index.php  ");
}
