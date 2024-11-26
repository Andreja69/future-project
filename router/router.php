<?php
require "routes.php";
if(array_key_exists(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $routes)) {
    require "../controllers/".$routes[parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)].'.php';
}else{
    echo "routes no existen";
}