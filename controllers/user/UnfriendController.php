<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
$fr->unfriend($_GET['id']);
header('location: /dashboard');
exit();