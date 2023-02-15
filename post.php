<?php
require_once("class/postCreate.php");

$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$username = $decode["username"];
$content = $decode["content"];
$userID = $decode["userID"];
$post = new Post($username, $content);
$userPushLog = $post->addPostInDB();
// $logs[] = array(
//     "Log : " . date_format(date_create("now"), "Y-m-d h:m:s")
// );
// echo json_encode($logs);
