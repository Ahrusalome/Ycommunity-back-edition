<?php 
$f = fopen("test.txt","w");
try{
    require_once "class/request.php";
    $request = new Request() ;
    echo json_encode($request->getAllCategories());
}catch(ERROR $e){
    fwrite($f,$e);
    echo("false");
}catch(Exception $e){
    fwrite($f,$e);
    echo("false");
}
?>