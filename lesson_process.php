<?php 

require_once("globals.php");
require_once("db.php");
require_once("models/Lesson.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/LessonDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$lessonDao = new LessonDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if($type === "create") {

    // Recebe dados do input
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $video = filter_input(INPUT_POST, "video");
    $category = filter_input(INPUT_POST, "category");
    $content = filter_input(INPUT_POST, "content");

    $lesson = new Lesson();

    // Valida dados minimos
    if(!empty($title) && !empty($description) && !empty($category)) {

    $lesson->title = $title;
    $lesson->description = $description;
    $lesson->video = $video;
    $lesson->category = $category;
    $lesson->content = $content;
    $lesson->users_id = $userData->id;

    // Upload de imagem do filme
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

    $image = $_FILES["image"];
    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
    $jpgArray = ["image/jpeg", "image/jpg"];

    // Checa o tipo da imagem 
    if (in_array($image["type"], $imageTypes)) {
        if (in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        } else {
            if (getimagesize($image["tmp_name"]) !== false) {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            } else {
                $message->setMessage("Arquivo PNG inválido!", "error", "index.php");
            }
        } 

        if ($imageFile) {
            $imageName = $lesson->imageGenerateName();
            imagejpeg($imageFile, "./img/lessons/" . $imageName, 100);
            $lesson->image = $imageName;
        }
    } else {
        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "index.php");
    }


    } 

    $lessonDao->create($lesson);

    } else {

    $message->setMessage("Você precisa ao menos adicionar: Titulo, Descrição e Categoria!", "error", "back");

    }

} else if($type == "delete"){


    // Recebe os dados do formulario
    $id = filter_input(INPUT_POST, "id");

    $lesson = $lessonDao->findById($id);

    if($lesson) {
    
    // Verificar se o filme e do usuario
    if ($lesson->users_id === $userData->id) {
    
    $lessonDao->destroy($lesson->id);

    } else {
    $message->setMessage("Informações inválidas", "error", "index.php");
    }

    } else {

    $message->setMessage("Informações inválidas", "error", "index.php");

    }
    
} else if ($type === "update") {

    // Recebe dados do input
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $video = filter_input(INPUT_POST, "video");
    $category = filter_input(INPUT_POST, "category");
    $content = filter_input(INPUT_POST, "content");  
    $id = filter_input(INPUT_POST, "id"); 

    $lessonData = $lessonDao->findById($id);

    // Verifica se encontrou filme
    if($lessonData) { 

    // Verificar se o filme e do usuario
    if ($lessonData->users_id === $userData->id) {

    // Valida dados minimos
    if(!empty($title) && !empty($description) && !empty($category)) {
    
    // Edita o filme
    $lessonData->title = $title;
    $lessonData->description = $description;
    $lessonData->video = $video;
    $lessonData->category = $category;
    $lessonData->content = $content;

    // Upload de imagem do filme
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

    $image = $_FILES["image"];
    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
    $jpgArray = ["image/jpeg", "image/jpg"];

    // Checa o tipo da imagem 
    if (in_array($image["type"], $imageTypes)) {
    if (in_array($image["type"], $jpgArray)) {
    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
    } else {
    if (getimagesize($image["tmp_name"]) !== false) {
    $imageFile = imagecreatefrompng($image["tmp_name"]);
    } else {
    $message->setMessage("Arquivo PNG inválido!", "error", "index.php");
    }
    }
    if ($imageFile) {
    $imageName = $lessonData->imageGenerateName();
    imagejpeg($imageFile, "./img/lessons/" . $imageName, 100);
    $lessonData->image = $imageName;
    }
    } else {
    $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "index.php");
    }
} 

    $lessonDao->update($lessonData);

        
    } else {

    $message->setMessage("Você precisa ao menos adicionar: Titulo, Descrição e Categoria!", "error", "back");

    } 

    } else {

    $message->setMessage("Informações inválidas", "error", "index.php");

    }
        
    } else {
        
    $message->setMessage("Informações inválidas", "error", "index.php");
        
    }

} else {

    $message->setMessage("Informações inválidas", "error", "index.php");

}