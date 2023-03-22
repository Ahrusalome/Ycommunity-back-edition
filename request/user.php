<?php
require_once "./class/userClass.php";
$require_method = $_SERVER["REQUEST_METHOD"];
switch ($require_method) {
    case 'POST':
        $encoded = file_get_contents("php://input");
        $decode = json_decode($encoded, true);
        if ($decode["islogin"]) {
            $username = $decode["username"];
            $password = $decode["password"];
            $user = new User($username, $password);
            if ($user->VerifyUserLog()) {
                echo json_encode(array("id" => $user->getFromDbByParam("user", "username", $username)["id"]));
            } else {
                echo json_encode("false");
            }
        } else {
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
        }
}
