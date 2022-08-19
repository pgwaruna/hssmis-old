<?php
namespace Src\Response;

class Response
{
    public function __construct()
    {

    }

    public function successResponse($message, $data)
    {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 200 Success');

        echo json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);

        return true;

    }

    public function errorNotFound($message) {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

        echo json_encode([
            'status' => 'error',
            'message' => $message,
        ]);

        return false;

    }

    public function invalidRequest($message){
        header( $_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');

        echo json_encode([
            'status' => 'error',
            'message' => $message,
        ]);

        return false;
    }

    // All errors and passed via this method
    public function unautorizedRequest($message){
        header( $_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized ');

        echo json_encode([
            'status' => 'error',
            'message' => $message,
        ]);

        return false;
    }
}
