<?php
require_once("class/postCreate.php");

$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$username = $decode["username"];
$content = $decode["content"];
$userID = $decode["userID"];
$post = new Post($username, $content);
$postPush = $post->addPostInDB();
