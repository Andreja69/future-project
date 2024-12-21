<?php

if(isset($_SESSION['user_id'])){
    $user = $db->getUser($_SESSION['user_id']);
}else{
    $user = new stdClass();
    $user->first_name = "Guest";
}
$posts = $po->getAllPosts();

view("home", ["user" => $user, "posts" => $posts]);
