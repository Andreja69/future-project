<?php
if(!isLogedIn()){

    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
$receiver_id = $_GET['receiver_id'];
if($fr->makeFriendRequest($user->id,$receiver_id)){
    Sessions::flash( "success", "Friend request sent");
    header('location: /dashboard');
    exit();
}

view("dashboard", ["user" => $user]);
