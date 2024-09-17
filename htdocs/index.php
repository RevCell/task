<?php

declare(strict_types=1);

//--------using single autoload without composer autoloader
spl_autoload_register(function ($class){
    require __DIR__."/src/".$class.".php";
});

//----------ErrorHandling Class compatible with json:
set_exception_handler("\\ErrorHandler::HandleError");


//----------set overall content type to json:
header("Content-type: application.json; charset=UTF-8");


//----------simple_uri :)
$uri= explode("/",$_SERVER['REQUEST_URI']);
if ($uri[2]!= "task"){
    http_response_code(404);
    exit();
}
$id=$uri[3];
//---------------------------

//----------passing auth data to db:
$database=new DataBase("localhost",'task','root','');



//----------creating a PDO instance:
$gateway=new MenuGateway($database);



//----------Fetching menu items with children:
$controller=new MenuController($gateway);



//super simple request handler! :)
$controller->process($_SERVER['REQUEST_METHOD'],$id);
?>