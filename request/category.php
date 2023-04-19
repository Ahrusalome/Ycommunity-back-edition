<?php
require_once("class/dbSetting.php");
$DB = new DBHandler();
$request_error = "You've got a wrong id or research";
$request_method = $_SERVER["REQUEST_METHOD"]; 
$request_URI = $_SESSION["request"];
switch($request_method){
    case 'GET':
        if(count($request_URI)>2){
            if(intval($request_URI[2])!=0){
                $result = $DB->getInDB("*","category","id",$request_URI[2]);
                if(count($result)>0)echo(json_encode($result));
                else echo("No category found with this ID");
            }
        }else{
            echo(json_encode($DB->getinDB("*","category")));
        }
}
?>