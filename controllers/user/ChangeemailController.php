<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    if ($db->changeEmail($email, $user->id)) {

        header('location: /user/profile');
        exit();
    }else{
        dd("not updated");
    }

}


view("change/change.email", ["user" => $user]);

