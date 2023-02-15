<?php
require_once("class/postCreate.php");
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $content = $decode["content"];
    $userID = $decode["userID"];
    $categoryID = $decode["categoryID"];
    $post = new Post($userID, $content,$categoryID);
    $postPush = $post->addPostInDB();

