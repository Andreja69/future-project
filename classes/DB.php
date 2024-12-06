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

    public function isUserFound($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([ $email]);
        return $stmt->rowCount();
    }

    public function changeFirstName( $firstname,$id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET first_name = ? , updated_at = NOW()  WHERE id = ?");
        $stmt->execute([ $firstname,$id ]);

        return $stmt->rowCount();

    }

    public function changeLastName( $lastname, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET last_name = ? , updated_at = NOW()  WHERE id = ?");
        $stmt->execute([$lastname,$id]);
        return $stmt->rowCount();
    }

    public function changeEmail( $email, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email = ? , updated_at = NOW()  WHERE id = ?");
        $stmt->execute([$email,$id]);
        return $stmt->rowCount();
    }

    public function changeUserName( $username, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET user_name = ? , updated_at = NOW()  WHERE id = ?");
        $stmt->execute([$username,$id]);
        return $stmt->rowCount();
    }

    public function isPasswordCorrect($old_password, $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(pdo::FETCH_OBJ);
        if(isset($user)) {
            if(password_verify($old_password, $user->password)) {
            return 1;

            }else{
                return 0;
            }
        }else{
            return 0;
        }

    }

    public function changePassword( $new_password, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password = ? , updated_at = NOW()  WHERE id = ?");
        $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT),$id]);
        return $stmt->rowCount();
    }

    public function findUsersByEmail( $email)
    {
        $stmt = $this->pdo->prepare("SELECT id, email, first_name
FROM users u
WHERE u.email LIKE ?
AND u.id NOT IN (
    SELECT receiver_id
    FROM friends_requests
    WHERE sender_id = ? AND state = 'pending'
)
AND u.id != ?;
");
        $stmt->execute(["%".$email."%", $_SESSION['user_id'],$_SESSION['user_id']]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}

