<?php
require_once("class/user.php");


$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$name = $decode["username"];
$password = $decode["password"];
$email = $decode["email"];
$user = new User($name, $password, $email);
$userPushLog = $user->pushUserInDB();
