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
            if(intval($request_URI[2])!=0){
                $result = $DB->getInDB("*","post","id",$request_URI[2]);
                echo(json_encode($result));
            }else{
                switch($request_URI[2]){
                    case 'category':
                        if(count($request_URI)>3){
                            if(intval($request_URI[3])!=0){
                                $result = $DB->getInDB("*","post","categoryID",$request_URI[3]);
                                echo(json_encode($result));
                            }
                        }
                        break;
                }
            }
        }else{
            echo(json_encode($DB->getInDB("*","post")));
        }
        break;
    case 'POST':
        addPost();
        break;
    case 'DELETE':
        if(count($request_URI)>2){
            if(intval($request_URI)!=0){
                deletePost($request_URI[2]);
            }else{
                echo(false);
            }
        }else{
            echo(false);
        }
        break;
}
function deletePost(int $postID){
    $request = new Request ;
    $request->deletePost($postID);
    echo(true);
}

function addPost(){
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $categoryID = $decode["categoryID"];
    $content = $decode["content"];
    $userID = $decode["userID"];
    $post = new Post($userID, $content,$categoryID);
    $postPush = $post->addPostInDB();
}

?>
