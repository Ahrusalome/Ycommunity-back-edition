<?php
class DBHandler
{
    private $name;
    private $user;
    private $password;
    private $host;

    function __construct()
    {
        $this->name = 'Ycommunity';
        $this->user = 'root';
        $this->password = '';
        $this->host = 'localhost';
    }

    public function connect()
    {
        try {
            $link = mysqli_connect($this->host, $this->user, $this->password, $this->name);
        } catch (Exception $e) {
            echo $e;
            die("Couldn't connect to db");
        }
        return $link;
    }

    public function insert(array $data, string $table)
    {
        $con = $this->connect();
        if ($con == false) {
            die("ERROR : couldn't connect properly to database : " . mysqli_connect_error());
        }
        $columns = array_keys($data);
        $values = array_values($data);
        $sql = "INSERT INTO Ycommunity.$table (" . implode(',', $columns) . ") VALUES (\"" . implode("\", \"", $values) . "\" )";
        $stmt = $con->prepare($sql);
        if (($stmt = $con->prepare($sql))) {
            $stmt->execute();
        } else {
            error_reporting(E_ALL);
            echo "there has been an issue with : " . $sql . " " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    public function getFromDbByParam(string $table, string $param, string $condition)
    {
        $con = $this->connect();
        if ($con == false) {
            die("ERROR : couldn't connect properly to database : " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM " . $table . " WHERE " . $param . " = '" . $condition . "'";
        if ($request = $con->prepare($sql)) {
            $request->execute();
            $result = $request->get_result();
        } else {
            die("Can't prepare the sql request properly : " . $sql . " " . mysqli_error($con));
        }
        mysqli_close($con);
        return $result->fetch_assoc();
    }

    public function getInDB(string $toSelect, string $table, string $rowToSearch = null, string|int $condition = null)
    {
        $db = $this->connect();
        $query = "";
        if (is_null($rowToSearch)) $query = "SELECT $toSelect FROM `$table`";
        else $query = "SELECT $toSelect FROM `$table` WHERE $rowToSearch = ?";
        $sql = $db->prepare($query);
        if (is_null($rowToSearch)) $sql->execute();
        else $sql->execute([$condition]);
        $resultQuery = $sql->get_result();
        $arrayData = [];
        while ($row = mysqli_fetch_assoc($resultQuery)) array_push($arrayData, $row);
        mysqli_close($db);
        return $arrayData;
    }

    public function getCommentsInfo(int $postID){
        $db =$this->connect() ;
        $sql = "SELECT comment.message, comment.id, comment.authorID, user.username 
        FROM comment 
        INNER JOIN user 
        ON user.id = comment.authorID 
        WHERE comment.postID = ?;
        ";
        $request = $db->prepare($sql);
        $request->execute([$postID]);
        $result = $request->get_result();
        $arrayData = [] ;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayData,$row);
        }
        return $arrayData ;
    }
    public function deleteLike($userID,$postID){
        $db = $this->connect() ;
        $sql = "DELETE FROM `postLike` WHERE postID = $postID AND  userID = $userID" ;
        $request = $db->prepare($sql) ;
        $request->execute();
        mysqli_close($db) ;
    }
    public function getAllPosts(){
        $db =$this->connect();
        $sql = "SELECT post.message, post.id,post.likes,post.userID,post.categoryID, user.username 
        FROM post 
        INNER JOIN user 
        ON user.id = post.userID; 
        ";
        $request = $db->prepare($sql);
        $request->execute();
        $result = $request->get_result();
        $arrayData = [] ;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arrayData,$row);
        }
        return $arrayData ;
    }
    public function updateLike($idPost,$removeLike=false){
        $db = $this->connect();
        $addOrRemoveLike = "likes+1";
        if($removeLike)$addOrRemoveLike = "likes-1";
        $sql = $db->prepare("UPDATE `post` SET `likes` = $addOrRemoveLike WHERE id = $idPost;");
        $sql->execute();
        mysqli_close($db) ;
    }
    
}                           