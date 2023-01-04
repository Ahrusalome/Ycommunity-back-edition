<?php
require_once "dbSetting.php";
class User extends DBHandler
{
    private $userName;
    private $userPassword;
    private $userEmail;

    function __construct($name, $password, $email = null)
    {
        parent::__construct();
        $this->userName = $name;
        $this->userPassword = $password;
        $this->userEmail = $email;
    }

    public function pushUserInDB()
    {
        $data = array(
            "username" => $this->userName,
            "email" => $this->userEmail,
            "password" => password_hash($this->userPassword, PASSWORD_DEFAULT)
        );
        if (empty($this->getFromDbByParam("user", "username", $this->userName)) && empty($this->getFromDbByParam("user", "email", $this->userEmail))) {
            $this->insert($data, "user");
            return "success";
        } else {
            return "already exist";
        }
    }

    public function VerifyUserLog(): bool
    {
        $userData = $this->getFromDbByParam("user", "username", $this->userName);
        if (empty($userData)) {
            return false;
        } else {
            if (password_verify($this->userPassword, $userData["password"])) {
                return true;
            }
        }
        return false;
    }
}
