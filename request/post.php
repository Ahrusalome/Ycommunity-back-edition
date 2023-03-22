<?php
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case "GET":
        require_once("class/request.php");
        $request = new Request;
        echo json_encode($request->getAllPost());
    case "POST":
        require_once("class/postCreate.php");
        $encoded = file_get_contents("php://input");
        $decode = json_decode($encoded, true);
        $username = $decode["username"];
        $content = $decode["content"];
        $userID = $decode["userID"];
        $post = new Post($username, $content);
        $postPush = $post->addPostInDB();
}
