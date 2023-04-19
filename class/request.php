<?php
require_once "dbSetting.php" ;
class Request extends DBHandler{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllPost($categoryID=null){
        $db =$this->connect() ;
        $sql = "SELECT post.id as postID,post.message,post.likes,post.categoryID, user.username 
        FROM post 
        INNER JOIN user 
        ON user.id = post.userID
        " ;
        if(!is_null($categoryID))$sql.="WHERE post.categoryID = $categoryID";
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
    public function getAllCategories(){
        $db =$this->connect() ;
        $sql = "SELECT * FROM category" ;
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

    public function getPostsCategory(){

    }

    public function getPost(int $id){
        $db =$this->connect() ;
        $sql = "SELECT post.id AS postId,post.message,post.likes,post.userID,post.categoryID,user.id AS userId,user.username 
        FROM post 
        INNER JOIN user 
        ON post.userID = user.id 
        WHERE post.id= $id;
        " ;
        if(!is_null($id))$sql.="WHERE post.categoryID = $id";
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
}

?>