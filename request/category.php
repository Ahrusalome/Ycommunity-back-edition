<?php
require_once("../class/dbSetting.php");
$request_method = $_SERVER["REQUEST_METHOD"]; 
echo("hii");
switch($request_method){
    case 'GET':
        getAllCategories();
}


function getAllCategories(){
    try{
        require_once("../class/request.php");
        $request = new Request ;
        echo json_encode($request->getAllCategories());
    }catch(ERROR $e){
        echo("false");
    }catch(Exception $e){
        echo("false");
    }
}
?>