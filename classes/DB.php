<?php
class DB{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;

    }

//    public function query($query, $data){
//        $stmt = $this->pdo->prepare($query);
//        $stmt->execute($data);
//        return $stmt;
//    }
    public function registerUser( $first_name,  $last_name,  $email,  $password,$user_name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users  (first_name, last_name, user_name, email, password) VALUES (?,?, ?,?,?)");
        $stmt->execute([$first_name, $last_name,$user_name,  $email, password_hash($password, PASSWORD_DEFAULT)]);
        return $this->pdo->lastInsertId();
    }

}

