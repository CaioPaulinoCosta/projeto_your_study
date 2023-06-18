<?php

require_once("models/Lesson.php");
require_once("models/Message.php");

  // Review DAO
  require_once("dao/ReviewDAO.php");

class LessonDAO implements LessonDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

   
    public function buildLesson($data) {

        $lesson = new lesson();

        $lesson->id = $data["id"];
        $lesson->title = $data["title"];
        $lesson->description = $data["description"];
        $lesson->image = $data["image"];
        $lesson->video = $data["video"];
        $lesson->category = $data["category"];
        $lesson->content = $data["content"];
        $lesson->users_id = $data["users_id"];

      // Recebe as ratings do filme
      $reviewDao = new ReviewDao($this->conn, $this->url);

      $rating = $reviewDao->getRatings($lesson->id);

      $lesson->rating = $rating;

        return $lesson;

    }

    public function findAll() {

    }
    public function getLatestLessons() {

        $lessons = [];

        $stmt = $this->conn->query("SELECT * FROM lessons ORDER BY
        id DESC");
    
        $stmt->execute();
    
        if($stmt->rowCount() > 0) {
            $lessonsArray = $stmt->fetchAll();
    
        foreach($lessonsArray as $lesson) {
            $lessons[] = $this->buildLesson($lesson);
        }
    
    }
        return $lessons;

    }
    public function getlessonsByCategory($category) {

        $lessons = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM lessons
                                      WHERE category = :category
                                      ORDER BY id DESC");
  
        $stmt->bindParam(":category", $category);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
          $lessonsArray = $stmt->fetchAll();
  
          foreach($lessonsArray as $lesson) {
            $lessons[] = $this->buildLesson($lesson);
          }
  
        }
  
        return $lessons;

    }
    public function getLessonsByUserId($id) {

        $lessons = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM lessons WHERE users_id = :users_id");
  
        $stmt->bindParam(":users_id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
            $lessonsArray = $stmt->fetchAll();
  
          foreach($lessonsArray as $lesson) {
            $lessons[] = $this->buildLesson($lesson);
          }
  
        }
  
        return $lessons;

    }

    public function findById($id) {

        $lessons = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM lessons WHERE id = :id");
  
        $stmt->bindParam(":id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
        $lessonData = $stmt->fetch();
  
        $lesson = $this->buildLesson($lessonData);
  
        return $lesson;
  
        } else {
  
        return false;
  
        }

    }
    public function findByTitle($title) {

        $lessons = [];

        $stmt = $this->conn->prepare("SELECT * FROM lessons
                                      WHERE title LIKE :title");
  
        $stmt->bindValue(":title", '%'.$title.'%');
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
            $lessonsArray = $stmt->fetchAll();
  
          foreach($lessonsArray as $lesson) {
            $lessons[] = $this->buildLesson($lesson);
          }
  
        }
  
        return $lessons;

    }
    public function create(lesson $lesson) {

        $stmt = $this->conn->prepare("INSERT INTO lessons (
            title, description, image, video, category, content, users_id
            ) VALUES (:title, :description, :image, :video, :category, :content, :users_id
            )");
    
            $stmt->bindParam(":title",  $lesson->title);
            $stmt->bindParam(":description",  $lesson->description);
            $stmt->bindParam(":image",  $lesson->image);
            $stmt->bindParam(":video",  $lesson->video);
            $stmt->bindParam(":category",  $lesson->category);
            $stmt->bindParam(":content",  $lesson->content);
            $stmt->bindParam(":users_id",  $lesson->users_id);
    
            $stmt->execute();
    
            // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
            $this->message->setMessage("Aula adicionada com sucesso!", "success", "index.php");

    }
    public function update(lesson $lesson) {

        $stmt = $this->conn->prepare("UPDATE lessons SET 
        title = :title,
        description = :description,
        image = :image,
        video = :video,
        category = :category,
        content = :content
        WHERE id = :id
      ");

      $stmt->bindParam(":title", $lesson->title);
      $stmt->bindParam(":description", $lesson->description);
      $stmt->bindParam(":image", $lesson->image);
      $stmt->bindParam(":video", $lesson->video);
      $stmt->bindParam(":category", $lesson->category);
      $stmt->bindParam(":content", $lesson->content);
      $stmt->bindParam(":id", $lesson->id);

      $stmt->execute();

      // Mensagem de sucesso por editar filme
      $this->message->setMessage("Aula atualizada com sucesso!", "success", "dashboard.php");

    }
    public function destroy($id) {

        $stmt = $this->conn->prepare("DELETE FROM lessons WHERE id = :id");

        $stmt->bindParam("id", $id);
    
        $stmt->execute();
    
        // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
        $this->message->setMessage("Aula removida com sucesso!", "success", "dashboard.php");

    }

  }