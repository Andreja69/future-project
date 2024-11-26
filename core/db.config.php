<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=future', 'root', '');
}catch(PDOException $e){
    echo $e->getMessage();
}