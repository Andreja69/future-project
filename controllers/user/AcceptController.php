<?php

if(!isLogedIn()){

    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
$fr->acceptRequest($_GET['id']);

header('location: /dashboard');
exit();
