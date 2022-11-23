<?php
require_once "dbSetting.php";
class User extends DBHandler
{
    private $userName;
    private $userPassword;
    private $userEmail;

    function __construct($name, $password, $email)
    {
        parent::__construct();
        $this->userName = $name;
        $this->userPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userEmail = $email;
    }

    public function pushUserInDB()
    {
        $data = array(
            "username" => $this->userName,
            "email" => $this->userEmail,
            "password" => $this->userPassword
        );
        if (empty($this->getFromDbByParam("user", "username", $this->userName)) && empty($this->getFromDbByParam("user", "email", $this->userEmail))) {
            $this->insert($data, "user");
            return "User has been successfully inserted into DB";
        } else {
            return "This user or email is already taken, function has been killed";
        }
    }
}

$user = new User("Micheleeeee", "motdepasse", "michel@gmail.com");
