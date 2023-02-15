<?php 
require_once "dbSetting.php" ;
class Post extends DBHandler{
    private string $message ;
    private string $username;
    private int $userID;

    function __construct(string $username, string $message)
    {
        parent::__construct();
        $this->message = $message ;
        $this->username = $username ;
        $this->userID = 1 ;
    }

    function addPostInDB(){
        try{
            $arrayData = [
                "message" => $this->message,
                "username" => $this->username,
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