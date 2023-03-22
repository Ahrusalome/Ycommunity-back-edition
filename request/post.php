<?php
require_once("../class/dbSetting.php");
require_once("../class/request.php");
require_once("class/postCreate.php");

$request_method = $_SERVER["REQUEST_METHOD"]; 
switch($request_method){
    case 'GET':
        if(!empty($_GET["id"])){

        }else{
            getAllPosts();
        }
    case 'POST':
        addPost();
    case 'DELETE':
        deletePost();
}

function getAllPosts(){
    $request = new Request ;
    echo json_encode($request->getAllPost());
}

function deletePost(){
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $postID = $decode["postID"];
    $request = new Request ;
    $request->deletePost($postID) ;
}

function addPost(){
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $username = $decode["username"];
    $content = $decode["content"];
    $userID = $decode["userID"];
    $post = new Post($username, $content);
    $postPush = $post->addPostInDB();
}

?>