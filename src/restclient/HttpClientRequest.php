<?php
error_reporting(-1);
include_once "HttpClient.php";

//use HttpClient;

class HttpClientRequest
{
    private $request;

    function __construct()
    {
        $this->request = new HttpClient();
    }

    /**
     * @param $email login email address
     * @param $password login password
     */
    public function login($email, $password){
        // API endpoint
        $url = '/login';

        // Post Request
        $data_array =  array(
            "email" => $email,
            "password" => $password
        );

        $response = $this->request->callAPI('POST', $url, json_encode($data_array));
        return $response;
    }
}
$request = new HttpClientRequest()
?>
