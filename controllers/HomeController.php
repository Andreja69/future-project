<?php
if(!isLogedIn()){
    header('location: /login');
    exit();
}
view("home");