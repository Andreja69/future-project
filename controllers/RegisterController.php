<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors_array = [];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_name = ucfirst($first_name[0]) . ucfirst($last_name[0]);

    $confirm_password = $_POST['confirm_password'];
    if($password != $confirm_password){
        $password_err = "Passwords do not match";
        $errors_array[] = "Passwords do not match";
    }
    if(count($errors_array) == 0 ){
        $id = $db->registerUser($first_name, $last_name, $email, $password, $user_name);
        $_SESSION['user_id'] = $id;

        header("location: /");
        exit();
    }
//    extract($_POST);
}
view("register", ['password_err'=> $password_err ?? ""]);

//require "../views/register.view.php";