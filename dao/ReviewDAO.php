<?php

require_once("models/Review.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("models/User.php");
require_once("dao/LessonDAO.php");

class ReviewDao implements ReviewDAOInterface {

private $conn;
private $url;
private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReview($data) {

    $reviewObject = new Review();

    $reviewObject->id = $data["id"];
    $reviewObject->rating = $data["rating"];
    $reviewObject->review = $data["review"];
    $reviewObject->users_id = $data["users_id"];
    $reviewObject->lessons_id = $data["lessons_id"];

    return $reviewObject;

    }

    public function create(Review $review) {

        $stmt = $this->conn->prepare("INSERT INTO reviews (
            rating, review, users_id, lessons_id
            ) VALUES (:rating, :review, :users_id, :lessons_id
            )");
    
            $stmt->bindParam(":rating", $review->rating);
            $stmt->bindParam(":review", $review->review);
            $stmt->bindParam(":users_id", $review->users_id);
            $stmt->bindParam(":lessons_id", $review->lessons_id);
    
            $stmt->execute();
    
            // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
            $this->message->setMessage("Critica adicionada com sucesso!", "success", "index.php");

    }

    public function getLessonReview($id) {

        $reviews = [];

        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE lessons_id = :lessons_id");

        $stmt->bindParam(":lessons_id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
        $reviewsData = $stmt->fetchAll();

        $userDao = new UserDAO($this->conn, $this->url);

        foreach($reviewsData as $review) {
            $reviewObject =  $this->buildReview($review);

            // Chama dados do usuario
            $user = $userDao->findById($reviewObject->users_id);

            $reviewObject->user = $user;

            $reviews[] = $reviewObject;
        }

        }
        return $reviews;

    }

    public function hasAlreadyReviewed($id, $userId) {

        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE lessons_id = :lessons_id AND users_id = :users_id");
  
        $stmt->bindParam(":lessons_id", $id);
        $stmt->bindParam(":users_id", $userId);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
          return true;
        } else {
          return false;
        }
  
      }

      
      public function getRatings($id) {

        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE lessons_id = :lessons_id");
  
        $stmt->bindParam(":lessons_id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
          $rating = 0;
  
          $reviews = $stmt->fetchAll();
  
          foreach($reviews as $review) {
            $rating += $review["rating"];
          }
  
          $rating = $rating / count($reviews);
  
        } else {
  
          $rating = "Não avaliado";
  
        }
  
        return $rating;
  
      }

      public function getLessonsByReview($id){

        $lessons = [];
  
          $stmt = $this->conn->prepare("SELECT * 
          FROM reviews 
          INNER JOIN users ON reviews.users_id = users.id 
          INNER JOIN lessons ON reviews.lessons_id = lessons.id 
          WHERE reviews.users_id = :user_id");
    
          $stmt->bindValue(":user_id", $id);
    
          $stmt->execute();
    
          if($stmt->rowCount() > 0) {
    
              $lessonsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
              $lessonDao = new LessonDAO($this->conn, $this->url);

            foreach($lessonsArray as $lesson) {
              $lessons[] = $lessonDao->buildLesson($lesson);

            }
    
          }
    
          return $lessons;
  
  
      }

}