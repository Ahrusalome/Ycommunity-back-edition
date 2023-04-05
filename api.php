<?php
$f = fopen("test.txt","w");
try{
    $_SESSION["request"] = explode("/",$_SERVER["REQUEST_URI"]);
    $request = $_SESSION["request"];
    switch ($request[1]) {
        case "post":
            require __DIR__ . '/request/post.php';
            break;
        case "user":
            require __DIR__ . '/request/user.php';
            break;
        case "category":
            require __DIR__ . '/request/category.php';
            break;
        default:
            http_response_code(404);
            break;
    }
}catch(ERROR $e){
    fwrite($f,$e);
}catch(Exception $e){
    fwrite($f,$e);
}
