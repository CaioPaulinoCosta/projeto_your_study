<?php

  require_once("models/User.php");
  require_once("models/Message.php");

  class UserDAO implements UserDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildUser($data) {

      $user = new User();

      $user->id = $data["id"];
      $user->name = $data["name"];
      $user->lastname = $data["lastname"];
      $user->email = $data["email"];
      $user->password = $data["password"];
      $user->image = $data["image"];
      $user->bio = $data["bio"];
      $user->ra = $data["ra"];
      $user->token = $data["token"];

      return $user;

    }

    public function create(User $user, $authUser = false) {

      $stmt = $this->conn->prepare("INSERT INTO users(
          name, lastname, email, password, ra, token
        ) VALUES (
          :name, :lastname, :email, :password, :ra, :token
        )");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":ra", $user->ra);
      $stmt->bindParam(":token", $user->token);

      $stmt->execute();

      // Autenticar usuário, caso auth seja true
      if($authUser) {
        $this->setTokenToSession($user->token);
      }

    }


    public function imgUpdate(User $user, $redirect = true) {
      $stmt = $this->conn->prepare("UPDATE users SET
        image = :image,
        token = :token
        WHERE id = :id
      ");

      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setCleanUpdate("edit_profile.php");

      }

    }
    
    public function update(User $user, $redirect = true) {
      $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        lastname = :lastname,
        email = :email,
        image = :image,
        bio = :bio,
        ra = :ra,
        token = :token
        WHERE id = :id
      ");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":bio", $user->bio);
      $stmt->bindParam(":ra", $user->ra);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "edit_profile.php");

      }

    }

    public function verifyToken($protected = false) {

      if(!empty($_SESSION["token"])) {

        // Pega o token da session
        $token = $_SESSION["token"];

        $user = $this->findByToken($token);

        if($user) {
          return $user;
        } else if($protected) {

          // Redireciona usuário não autenticado
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

        }

      } else if($protected) {

        // Redireciona usuário não autenticado
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

      }

    }

    public function setTokenToSession($token, $redirect = true) {

      // Salvar token na session
      $_SESSION["token"] = $token;

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Seja bem-vindo!", "success", "edit_profile.php");

      }

    }

    public function authenticateUser($email, $password) {

      $user = $this->findByEmail($email);

      if($user) {

        // Checar se as senhas batem
        if(password_verify($password, $user->password)) {

          // Gerar um token e inserir na session
          $token = $user->generateToken();

          $this->setTokenToSession($token, false);

          // Atualizar token no usuário
          $user->token = $token;

          $this->update($user, false);

          return true;

        } else {
          return false;
        }

      } else {

        return false;

      }

    }

    public function findByEmail($email) {

      if($email != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          
          return $user;

        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    public function findById($id) {

      if($id != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          
          return $user;

        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    public function findByLessonId($lessonId) {
      $users = [];
  
      $stmt = $this->conn->prepare("SELECT *
      FROM users
      WHERE id IN (
          SELECT users_id
          FROM lessons
          WHERE id = :lessonId
      );
      ");

  
      $stmt->bindValue(":lessonId", $lessonId);
  
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
          $usersArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
          foreach ($usersArray as $user) {
              $users[] = $this->buildUser($user); // Certifique-se de que $userDao esteja definido corretamente.
          }
      }
  
      return $users;
  }
  

    public function findByToken($token) {

      if($token != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");

        $stmt->bindParam(":token", $token);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          
          return $user;

        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    public function destroyToken() {

      // Remove o token da session
      $_SESSION["token"] = "";

      // Redirecionar e apresentar a mensagem de sucesso
      $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");

    }

    public function changePassword(User $user) {

      $stmt = $this->conn->prepare("UPDATE users SET
        password = :password
        WHERE id = :id
      ");

      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      // Redirecionar e apresentar a mensagem de sucesso
      $this->message->setMessage("Senha atualizada com sucesso!", "success", "edit_profile.php");

    }

    public function getReviewedLessons($userId) {
      // Consulta o banco de dados para obter as lições avaliadas pelo usuário
      $stmt = $this->conn->prepare("SELECT DISTINCT lessons_id FROM Reviews WHERE users_id = :users_id");
      $stmt->bindParam(':users_id', $userId);
      $stmt->execute();
  
      $lessonIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
      // Retornar a lista de IDs das lições avaliadas
      return $lessonIds;
    }
  

    public function findAllUsers() {
      $stmt = $this->conn->prepare('SELECT * FROM users WHERE id >1;');
      $stmt->execute();
      
      $users = $stmt->fetchAll();
      
      return $users;
    }
    // ...
  }


  