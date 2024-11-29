<?php
if(!isLogedIn()){

    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
view("dashboard", ["user" => $user]);

