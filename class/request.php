<?php
require_once "dbSetting.php" ;
class Request extends DBHandler{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllPost(){
        $db =$this->connect() ;
        $sql = "SELECT * FROM post" ;
        if ($request = $db->prepare($sql)) {
            $request->execute();
            $result = $request->get_result();
        } else {
            error_reporting(E_ALL);
            echo "there has been an issue with : " . $sql . " " . mysqli_error($db);
        }
        mysqli_close($db);
        $arrayData = [] ;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayData,$row);
        }
        return $arrayData ;
    }

    public function deletePost(int $postId){
        $db = $this->connect() ;
        $sql = "DELETE FROM `post` WHERE id = ?" ;
        $request = $db->prepare($sql) ;
        $request->execute([$postId]);
        mysqli_close($db) ;
    }
}

?>