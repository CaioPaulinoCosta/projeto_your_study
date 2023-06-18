<?php

require_once("models/Grade.php");
require_once("models/Message.php");

  // Review DAO
  require_once("dao/ReviewDAO.php");

class GradeDAO implements GradeDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }


    public function buildGrade($data) {

        $grade = new Grade();

        $grade->id = $data["id"];
        $grade->p1 = $data["p1"];
        $grade->p2 = $data["p2"];
        $grade->p3 = $data["p3"];
        $grade->p4 = $data["p4"];
        $grade->t1 = $data["t1"];
        $grade->t2 = $data["t2"];
        $grade->average = $data["average"];
        $grade->users_id = $data["users_id"];

        return $grade;

    }
    public function findAll() {

    }
    public function findById($id){
      $grades = [];
  
      $stmt = $this->conn->prepare("SELECT * FROM grades WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

      $gradeData = $stmt->fetch();

      $grade = $this->buildGrade($gradeData);

      return $grade;

      } else {

      return false;

      }
    }

    public function getGradesByUserId($id) {

        $grades = [];
  
        $stmt = $this->conn->prepare("SELECT *
        FROM grades
        WHERE users_id = :id;
        ");
  
        $stmt->bindParam(":id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
            $gradesArray = $stmt->fetchAll();
  
          foreach($gradesArray as $grade) {
            $grades[] = $this->buildGrade($grade);
          }
  
        }
  
        return $grades;

    }
    public function create(Grade $grade) {

      $stmt = $this->conn->prepare("INSERT INTO grades (
        p1, p2, p3, p4, t1, t2, average, users_id
        ) VALUES (:p1, :p2, :p3, :p4, :t1, :t2, :average, :users_id
        )");

        $stmt->bindParam(":p1",  $grade->p1);
        $stmt->bindParam(":p2",  $grade->p2);
        $stmt->bindParam(":p3",  $grade->p3);
        $stmt->bindParam(":p4",  $grade->p4);
        $stmt->bindParam(":t1",  $grade->t1);
        $stmt->bindParam(":t2",  $grade->t2);
        $stmt->bindParam(":average",  $grade->average);
        $stmt->bindParam(":users_id",  $grade->users_id);

        $stmt->execute();

        // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
        $this->message->setMessage("Notas atribuidas com sucesso!", "success", "manage_students.php");

    }
    public function update(Grade $grade) {

      $stmt = $this->conn->prepare("UPDATE grades SET 
      p1 = :p1,
      p2 = :p2,
      p3 = :p3,
      p4 = :p4,
      t1 = :t1,
      t2 = :t2,
      average = :average
      WHERE id = :id
    ");    

    $stmt->bindParam(":p1", $grade->p1);
    $stmt->bindParam(":p2", $grade->p2);
    $stmt->bindParam(":p3", $grade->p3);
    $stmt->bindParam(":p4", $grade->p4);
    $stmt->bindParam(":t1", $grade->t1);
    $stmt->bindParam(":t2", $grade->t2);
    $stmt->bindParam(":average", $grade->average);
    $stmt->bindParam(":id", $grade->id);

    $stmt->execute();

    // Mensagem de sucesso por editar filme
    $this->message->setMessage("Notas atualizadas com sucesso!", "success", "manage_students.php");

    }
    
    public function destroy($id) {

      $stmt = $this->conn->prepare("DELETE FROM grades WHERE id = :id");

      $stmt->bindParam("id", $id);
  
      $stmt->execute();
  
      // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
      $this->message->setMessage("Notas deletadas com sucesso!", "success", "dashboard.php");

  }

    }

