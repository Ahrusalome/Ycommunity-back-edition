<?php
require_once("class/user.php");

$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$name = $decode["username"];
$password = $decode["password"];
$email = $decode["email"];
$user = new User($name, $password, $email);
$userPushLog = $user->pushUserInDB();
if ($userPushLog == "already exist") {
    $state = "This user already exist";
} else {
    $state = "Compte créer avec succès";
}
$logs[] = array("State" => $state);
echo json_encode($logs);
