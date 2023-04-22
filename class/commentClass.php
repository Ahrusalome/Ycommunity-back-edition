<?php 
require_once "dbSetting.php" ;
class Comment extends DBHandler{
    private string $message ;
    private int $postID;
    private int $authorID;

    function __construct(int $postID, string $message,int $authorID)
    {
        parent::__construct();
        $this->message = $message ;
        $this->authorID = $authorID ;
        $this->postID = $postID;
    }

    function addPostInDB(){
        try{
            $arrayData = [
                "message" => $this->message,
                "postID" => $this->postID,
                "authorID" => $this->authorID,
            ] ;
            $this->insert($arrayData,"comment");
            echo("true");
        }catch(ERROR $e){
            echo("false");
        }catch(Exception $e){
            echo("false");
        }
    }
}
?>