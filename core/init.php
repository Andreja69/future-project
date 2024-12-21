<?php
session_start();
require "../utils/function.php";
require "db.config.php";
require "../classes/DB.php";
require "../classes/Friends.php";
require "../classes/Sessions.php";
require "../classes/Posts.php";
$po = new Posts($pdo);
$fr = new Friends($pdo);
$db = new DB($pdo);
require "../router/router.php";



