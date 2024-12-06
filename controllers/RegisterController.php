<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors_array = [];
    if($_POST['first_name'] ?? false){
        $first_name = $_POST['first_name'];
    }else{
        $first_name_err = "Please enter your first name";
        $errors_array['first_name'] = $first_name_err;
    }

    if($_POST['last_name'] ?? false){
        $last_name = $_POST['last_name'];
    }else{
        $last_name_err = "Please enter your last name ";
        $errors_array['last_name'] = $last_name_err;
    }

    if($_POST['email'] ?? false){
        $email = $_POST['email'];
    }else{
        $email_err = "Please enter your email";
        $errors_array['email'] = $email_err;
    }

    if($_POST['password'] ?? false){
        $password = $_POST['password'];
    }else{
        $password_err = "Please enter your password";
        $errors_array['password'] = $password_err;
    }

    if($_POST['confirm_password'] ?? false){
        $confirm_password = $_POST['confirm_password'];
    }else{
        $confirm_password_err = "Please confirm your password";
        $errors_array['confirm_password'] = $confirm_password_err;
    }

    if(count($errors_array) == 0){
        if($password != $confirm_password){
            $password_match_err = "Passwords do not match";
            $errors_array['password_match'] = $password_match_err;
        }
        $user_name = ucfirst($first_name[0]) . ucfirst($last_name[0]);

    }
    if(count($errors_array) == 0 ){
        $x = $db->isUserFound($email);
        if($x){
            $account_exist_err = "Account already exist";
        }else{
            $id = $db->registerUser($first_name, $last_name, $email, $password, $user_name);
            $_SESSION['user_id'] = $id;

            header("location: /");
            exit();
        }

    }
//    extract($_POST);
}
view("register", [
    //Errors
    "first_name_err" => $first_name_err ?? '',
    "last_name_err" => $last_name_err ?? '',
    "email_err" => $email_err ?? '',
    "password_err" => $password_err ?? '',
    "confirm_password_err" => $confirm_password_err ?? '',
    "password_match_err" => $password_match_err ?? '',
    "account_exist_err" => $account_exist_err ?? '',
    //Values
    "first_name" => $first_name ?? '',
    "last_name" => $last_name ?? '',
    "email" => $email ?? '',
] ?? "");

//require "../views/register.view.php";