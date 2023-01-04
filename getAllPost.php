<?php 
require_once("class/request.php");
$request = new Request ;
echo json_encode($request->getAllPost()) ;
return json_encode($request->getAllPost()) ;
