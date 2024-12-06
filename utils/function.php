<?php
function isLogedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}

function view($path, $data = []){
    extract($data);
    require "../views/".$path.".view.php";
}


function dd($val){
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    die();
}