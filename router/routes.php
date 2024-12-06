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
    "/accept" =>"user/AcceptController",
    "/API" => "API/searchUsers",


];

//$route->get("/user", "User@destroy")->auth