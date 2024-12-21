<?php


$routes = [
    "/" => "HomeController",
    "/login" => "LoginController",
    "/register" => "RegisterController",
    "/dashboard" => "user/DashboardController",
    "/logout" => "user/LogoutController",
    "/user/profile" => "user/ProfileController",
    "/change/firstname" =>"user/ChangefirstnameController",
    "/change/lastname" =>"user/ChangelastnameController",
    "/change/email" =>"user/ChangeemailController",
    "/change/username" =>"user/ChangeusernameController",
    "/change/password" =>"user/ChangepasswordController",
    "/user/friendrequest" =>"user/FriendrequestController",
    "/user/unfriend" =>"user/UnfriendController",
    "/user/create-post" =>"user/CreatepostController",
    "/accept" =>"user/AcceptController",
    "/API" => "API/searchUsers",


];

//call_user_func()
//$route->get("/user", "User@destroy")->auth