<?php
require_once("class/dbSetting.php");
require_once("class/request.php");
require_once("class/postCreate.php");
require_once("header.php");
$request_error = "You've got a wrong id or research";
$request_method = $_SERVER["REQUEST_METHOD"]; 
$request_URI = $_SESSION["request"];
$DB = new DBHandler();
switch($request_method){
    case 'GET':
        if(count($request_URI)>2){
            if(intval($request_URI[2]!=0)){
                $result = $DB->getInDB("*","post","id",$request_URI[2]);
                if(count($result)>0)echo(json_encode($result));
                else echo("No post with this ID found");
            }else{
                echo($request_error);
            }
        }
        break;
    case 'POST':
        addPost();
        break;
    case 'DELETE':
        deletePost();
        break;
}
function deletePost(){
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $postID = $decode["postID"];
    $request = new Request ;
    $request->deletePost($postID);
    echo(true);
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
