<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$input = json_decode(file_get_contents('php://input'), true);

$users = $db->findUsersByEmail($input['email']);

echo json_encode($users);