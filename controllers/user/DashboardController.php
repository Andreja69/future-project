<?php
if(!isLogedIn()){

    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
$friend_requests = $fr->getFrinedsRequests($_SESSION['user_id']);
$all_friends = $fr->getAllFriends($_SESSION['user_id']);
$all_posts = $po->getUserPosts($user->id);

view("dashboard", ["user" => $user,"friend_requests" => $friend_requests,"all_friends" => $all_friends, "all_posts" => $all_posts ]);

