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

    public function logInUser(mixed $email, mixed $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(pdo::FETCH_OBJ);
        if(isset($user)){
            if(password_verify($password, $user->password)){
                $_SESSION['login'] = "success";
                $_SESSION['user_id'] = $user->id;
                return true;

            }else{
                dd("Wrong password");
//                header("location:  /login");
            }
        }else{
            dd("Wrong email");
//              header("location:  /login");

        }
    }
    public function getUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(pdo::FETCH_OBJ);
        if(isset($user)){
            return $user;

        }else{
            header('Location: /404');
            exit();
        }
    }


}

