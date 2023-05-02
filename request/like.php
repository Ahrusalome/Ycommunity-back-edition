<?php
require_once("class/dbSetting.php");
$require_method = $_SERVER["REQUEST_METHOD"];
$request_URI = $_SESSION["request"];
$DB = new DBHandler();
switch ($require_method) {
    case 'POST':
        $encoded = file_get_contents("php://input");
        $decode = json_decode($encoded, true);
        $userID = $decode["userID"];
        $postID = $decode["postID"];
        $data = [
            "userID"=> $userID,
            "postID"=> $postID,
        ];
        $DB->insert($data,"postlike");
        echo(true);
        break;
    case 'GET':
        if(count($request_URI)>2){
            if(intval($request_URI[2])!=0){

            } else {
                switch($request_URI[2]){
                    case 'user':
                        if(count($request_URI)>3){
                            if(intval($request_URI[3])!=0){
                                $userID = $request_URI[3];
                                $res = $DB->getInDB("*","postLike","userID",$userID);
                                if(count($res)>0)echo(json_encode($res));
                                else echo(false);
                                break;
                            }
                        }
                }
            }
        }
        break;
    case 'DELETE':
        if(count($request_URI)>3){
            if(intval($request_URI[3])!=0){
                    $userID = intval($request_URI[2]);
                    $postID = intval($request_URI[3]);
                    $DB->deleteLike($userID,$postID);
            }
            break;
        }
        break;
}
