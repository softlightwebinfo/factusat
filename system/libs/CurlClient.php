<?php

class cUrlClient
{
    private $url;
    private $returnTransfer;
    private $jsonOutput;

    function __construct($url, $rt = 1, $jsonO = false)
    {

        $this->url = $url;
        $this->returnTransfer = $rt;
        $this->jsonOutput = $jsonO;

    }

    function execute()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $this->returnTransfer);
        if ($this->jsonOutput == false) {
            $output = json_decode(curl_exec($ch), true);
        } else {
            $output = curl_exec($ch);
        }
        curl_close($ch);

        return $output;
    }

    function exec($method = "GET", $data = array())
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        switch ($method) {
            case "POST":
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $this->returnTransfer);
        if ($this->jsonOutput != false) {
            $output = json_decode(curl_exec($ch), true);
        } else {
            $output = curl_exec($ch);
        }
        curl_close($ch);

        return $output;
    }
}
