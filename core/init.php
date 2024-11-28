<?php
session_start();
require "../utils/function.php";
require "db.config.php";
require "../classes/DB.php";
$db = new DB($pdo);
require "../router/router.php";



