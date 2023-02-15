<?php 
require_once "dbSetting.php" ;
class Post extends DBHandler{
    private string $message ;
    private int $userID;

    function __construct(int $userID, string $message)
    {
        parent::__construct();
        $this->message = $message ;
        $this->userID = $userID ;
    }

    function addPostInDB(){
        try{
            $arrayData = [
                "message" => $this->message,
                "userID" => $this->userID,
            ] ;
            $this->insert($arrayData,"post");
            echo("true");
        }catch(ERROR $e){
            echo("false");
        }catch(Exception $e){
            echo("false");
        }
    }
}
?>