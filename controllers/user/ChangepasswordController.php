<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    if($db->isPasswordCorrect($old_password,$user->id)){
        if($db->changePassword($new_password,$user->id)){
            header('location: /user/profile');
            exit();
        }else{
            dd("not updated");
        }
    }else{
        $old_password_err = "Wrong password";
    }


}


view("change/change.password", ["user" => $user,
    "error" => $old_password_err ?? ""]);

