<?php
session_start();

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

spl_autoload_register(function ($class_name) {
    $iterator = new DirectoryIterator(dirname(__FILE__));
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    $className = str_replace("Api/", "", $className);
    $files = $iterator->getPath()."/".$className.".php";
    
    if (file_exists($files)) {
            include($files);
    } else {
       die("Warning:The file {$files} could not be found!");
    }
});

$client = new Api\Client();

$route  = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$route = substr($route, 1);
$route = explode("?", $route);
$route = explode("/", $route[1]);
$route = array_values($route);


if (count($route) <= 2) {
    switch ($route[0]) {
        case 'login':
            $credential = new Api\Concretes\Credential();
            $credential->username = $_POST["username"]; //sledge00
            $credential->password = md5($_POST["password"]); //1234
            $credential->db = $client->db;
	    echo $credential->authenticate();
	    break;
        
	case 'bet':
	  
            $wallet = new Api\Concretes\Wallet();
            $wallet->db = $client->db;
            $wallet->get();

            $amount = $_POST["amount"];
	    $finance_type_id = $_POST['finance_type']; //3 (bet)

	    if ($wallet->get()['balance']<$amount)
            {
	        echo Api\Utils\JsonResponse::get("Not enough balance to bet!");
	    }
            else
	    {
                $finance = new Api\Concretes\Finance($amount, $finance_type_id);
                $finance->db = $client->db;
                if ($finance->post([]))
                {
                    $wallet->balance = $finance->payout;
                    if ($wallet->put([])) 
                    {
                        echo Api\Utils\JsonResponse::get("Your new balance is: ".$wallet->get()['balance']."");
                    }
                    else
                    {
                        echo Api\Utils\JsonResponse::get([]);
                    }
                 }
                 else
                 {
                    echo Api\Utils\JsonResponse::get([]);
	         }
	    }
	    break;

	 default:
	    echo Api\Utils\JsonResponse::get([]);
	    break;

    }
}

