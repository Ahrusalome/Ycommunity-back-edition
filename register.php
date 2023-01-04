<?php
require_once("class/user.php");

$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
echo $decode;
$name = $decode["username"];
$password = $decode["password"];
$email = $decode["email"];
$user = new User($name, $password, $email);
$userPushLog = $user->pushUserInDB();
$logs[] = [
    "Log : " . date_format(date_create(), "Y-m-d h:m:s")
];
echo json_encode($logs);
