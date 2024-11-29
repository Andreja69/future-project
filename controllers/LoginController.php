<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($db -> logInUser($email, $password)){
        header('Location: /dashboard');
        exit();
    }

}
view("login");