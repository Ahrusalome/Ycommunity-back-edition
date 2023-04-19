<?php 
require_once "dbSetting.php" ;
class Post extends DBHandler{
    private string $message ;
    private int $userID;
    private int $categoryID;

    function __construct(int $userID, string $message,int $categoryID)
    {
        parent::__construct();
        $this->message = $message ;
        $this->userID = $userID ;
        $this->categoryID = $categoryID;
    }

    function addPostInDB(){
        try{
            $arrayData = [
                "message" => $this->message,
                "userID" => $this->userID,
                "categoryID" => $this->categoryID,
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