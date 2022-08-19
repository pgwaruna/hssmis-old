<?php
error_reporting(-1);
require_once "vendor/autoload.php";
require_once "bootstrap.php";

use Src\System\Authenticate;
use Src\Response\Response;
use Src\Controller\UserController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Lay request URI.
    $request = $_SERVER['REQUEST_URI'];

    $array = explode("/", $request);

// If the sending ip is available with
    $ips = getenv('ALLOWED_IPS');
    $allowedIps = explode(',', $ips);
    //$ip = $_SERVER['REMOTE_HOST'];
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!in_array($ip, $allowedIps)) {
        $response =  new Response();
        return $response->unautorizedRequest('unauthorized');
    }

// Route token parameter initiate
// Route token parameter initiate
    $id = strval(end($array));

    $router = [
        'GET',"/fohssmis/rumis_api/v1/user/$id" => 'UserController@getUserById',
        'POST','/fohssmis/rumis_api/v1/user/changepass' => 'UserController@changePass',
        'POST','/fohssmis/rumis_api/v1/user/resetpass' => 'UserController@resetPass',
    ];

    function checkRouting($router, $requestUri)
    {
        if (isset($router[$requestUri]))
        {
            return true;
        }
        return false;
    }

    if (checkRouting($router, $request)) {

        $auth = new Authenticate();

        if ($auth->handle())
        {
            $requestMethod = $_SERVER["REQUEST_METHOD"];

            // Get all users
            $user = new UserController($dbConnection);

            if($request === "/fohssmis/rumis_api/v1/user/$id" && $requestMethod==='GET') {
                $user->getUserById($id);
            }

            if($request === "/fohssmis/rumis_api/v1/user/changepass" && $requestMethod==='POST') {
                $request = json_decode(file_get_contents('php://input'), TRUE);
                $user->changePass($request);
            }

            // Reset password
            if($request === "/fohssmis/rumis_api/v1/user/resetpass" && $requestMethod==='POST') {
                $request = json_decode(file_get_contents('php://input'), TRUE);
                $user->resetPassword($request);
            }
        }
    } else {
        $response = new Response();
        $response->errorNotFound('not_found');
    }
