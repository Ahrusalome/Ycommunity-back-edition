<?php 
try{
    require_once "class/request.php";
    $request = new Request() ;
    echo json_encode($request->getAllCategories());
}catch(ERROR $e){
    echo("false");
}catch(Exception $e){
    echo("false");
}
?>