<?php
require_once("./class/user.php");

$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$username = $decode["username"];
$password = $decode["password"];

$user = new User($username, $password);
if ($user->VerifyUserLog()) {
    echo json_encode("true");
} else {
    echo json_encode("false");
}
