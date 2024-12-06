<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['first_name'];
    if ($db->changeFirstName($firstname, $user->id)) {

        header('location: /user/profile');
        exit();
    }else{
        dd("not updated");
    }

}


view("change/change.firstname", ["user" => $user]);

