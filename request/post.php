<?php
require_once("../class/dbSetting.php");
require_once("../class/request.php");
require_once("../class/postCreate.php");
require_once("../header.php");
$f = fopen("../test.txt");
$request_method = $_SERVER["REQUEST_METHOD"]; 
fwrite($file,$request_method);
switch($request_method){
    case 'GET':
        if(!empty($_GET["id"])){
            getPosts(intval($_GET["id"]));
        }else{
            getPosts();
        }
    case 'POST':
        addPost();
    case 'DELETE':
        deletePost();
}

function getPosts($id=0){
    $request = new Request ;
    if($id==0){
        if(!empty($_GET["categoryID"])){
            echo json_encode($request->getAllPost(intval($_GET["categoryID"])));
        }else{
            echo json_encode($request->getAllPost());
        }
    }else{
        echo json_encode($request->getPost($id));
    }
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