<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    if ($db->changeUserName($username, $user->id)) {

        header('location: /user/profile');
        exit();
    }else{
        dd("not updated");
    }

}


view("change/change.username", ["user" => $user]);

