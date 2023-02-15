<?php 
    $f = fopen("test.txt","w");
try{
    require_once("class/request.php");
    $encoded = file_get_contents("php://input");
    $decode = json_decode($encoded, true);
    $categoryID = $decode["categoryID"];
    if(is_null($categoryID))fwrite($f,"nullllllll");
    else fwrite($f,"not null");
    $request = new Request ;
    echo json_encode($request->getAllPost($categoryID));
}catch(ERROR $e){
    fwrite($f,$e);
}catch(Exception $e){
    fwrite($f,$e);
}
?>