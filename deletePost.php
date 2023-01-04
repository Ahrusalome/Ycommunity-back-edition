<?php 
require_once("class/request.php");
$encoded = file_get_contents("php://input");
$decode = json_decode($encoded, true);
$postID = $decode["postID"];
$request = new Request ;
$request->deletePost($postID) ;
