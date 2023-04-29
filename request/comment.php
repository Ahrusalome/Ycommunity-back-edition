<?php
try{

    require_once("class/dbSetting.php");
    require_once("class/request.php");
    require_once("class/commentClass.php");
    require_once("header.php");
    $request_error = "You've got a wrong id or research";
    $request_method = $_SERVER["REQUEST_METHOD"]; 
    $request_URI = $_SESSION["request"];
    $DB = new DBHandler();
    $request = new Request();
    switch($request_method){
        case 'GET':
            if(count($request_URI)>2){
                if(intval($request_URI[2])!=0){
                    $result = $DB->getInDB("*","comment","id",$request_URI[2]);
                    echo(json_encode($result));
                }else{
                    switch($request_URI[2]){
                        case 'post':
                            if(count($request_URI)>3){
                                if(intval($request_URI[3])!=0){
                                    $result = $DB->getCommentsInfo(intval($request_URI[3]));
                                    echo(json_encode($result));
                                }
                            }
                            break;
                        case 'author':
                            if(count($request_URI)>3){
                                if(intval($request_URI[3])!=0){
                                    $result = $DB->getInDB("*","comment","authorID",$request_URI[3]);
                                    echo(json_encode($result));
                                }
                            }
                        break;
                    }
                }
            }else{
                echo(json_encode($DB->getInDB("*","comment")));
            }
            break;
        case 'POST':
            $encoded = file_get_contents("php://input");
            $decode = json_decode($encoded, true);
            $postID = $decode["postID"];
            $content = $decode["content"];
            $authorID = $decode["authorID"];
            if(intval($authorID)!=0){
                $post = new Comment($postID, $content,intval($authorID));
                $postPush = $post->addPostInDB();
            } else echo($authorID);
            break;
        case 'DELETE':
            if(count($request_URI)>2){
                if(intval($request_URI)!=0){
                    deleteComment($request_URI[2]);
                }else{
                    echo(false);
                }
            }else{
                echo(false);
            }
            break;
    }
    function deleteComment(int $postID){
        $request = new Request;
        $request->deleteById("comment",$postID);
        echo(true);
    }
    
    function addComment(){
        $encoded = file_get_contents("php://input");
        $decode = json_decode($encoded, true);
        $postID = $decode["postID"];
        $content = $decode["content"];
        $authorID = $decode["authorID"];
        $post = new Comment($postID, $content,$authorID);
        $postPush = $post->addPostInDB();
    }
}catch(Error $e){
    echo $e;
}catch(Exception $e){
    echo $e;
}

?>
