<?php 
require_once('vendor/autoload.php');

use App\Controller; 
use App\Model;
//constante globales
define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

//on separe les parametres de l'url
$params = explode('/',$_GET['p']);


//load du model et controlleur principale
// require_once(ROOT.'app/Model.php');
// require_once(ROOT.'app/Controller.php');
//verifie si un parametre existe
if($params[0] != ""){ 
    $controller =  ucfirst($params[0]);
    
    $action = isset($params[1]) ? $params[1] : 'index';
    
    $controller = "App\Controllers\\".$controller;

    $controller = new $controller;

    if(method_exists($controller,$action)){

        unset($params[0]);
        unset($params[1]);

        call_user_func_array([$controller, $action],$params);
    }else {
        http_response_code(404);
        echo " la methode n'existe pas n'exixste pas";
    }
   
}else {
    //require_once(ROOT.'Views/pages/menus/index.php');
    http_response_code(404);
    echo " la page n'exixste pas";
}