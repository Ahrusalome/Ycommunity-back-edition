<?php
abstract class DBHandler
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
        $link = mysqli_connect($this->host, $this->user, $this->password, $this->name);
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
        if ($stmt = $con->prepare($sql)) {
            $stmt->execute();
            echo 'successfully inserted : ' . $sql;
        } else {
            echo "there has been an issue with : " . $sql . " " . mysqli_error($con);
        }
        mysqli_close($con);
    }
}
