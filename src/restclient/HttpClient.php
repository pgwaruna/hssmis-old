<?php
error_reporting(-1);
class HttpClient
{
    private $token;
    private $base_url;
    private $proxy;
    private $port;

    function __construct()
    {
        $this->token ='2c62902b14b0908cc70a6cf023183eb968454e84620883a4e98b828db96e5d24';
        $this->base_url = 'gtwapi_nginx/api';
        $this->proxy = '';
        $this->port = '';
    }

    /**
     * @param $method GET, POST, PUT
     * @param $url API url to send request
     * @param $data Data to send on curl request
     * @param bool $headers headers
     * @return bool|string return the response from curl request
     *
     */
    function callAPI($method, $url, $data, $headers = true){


        $full_url = $this->base_url.$url;

        // create & initialize a curl session
        $curl = curl_init();

        // Set proxy for curl if avilable
        if($this->proxy){
            curl_setopt($curl, CURLOPT_PROXY, $this->proxy);
            curl_setopt($curl, CURLOPT_PROXYPORT, $this->port);
        }

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $full_url = sprintf("%s?%s", $full_url, http_build_query($data));
        }
        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, $full_url);

        if(!$headers){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'APIKEY: ',
                'Content-Type: application/json',
            ));
        }else{
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'APIKEY: ',
                'Content-Type: application/json',
                $headers
            ));
        }

        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // curl_exec() executes the started curl session
        // $result contains the output string
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        return $result;
        curl_close($curl);

    }
}
$client = new HttpClient()
?>
