<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['last_name'];
    if ($db->changeLastName($lastname, $user->id)) {

        header('location: /user/profile');
        exit();
    }else{
        dd("not updated");
    }

}


view("change/change.lastname", ["user" => $user]);

