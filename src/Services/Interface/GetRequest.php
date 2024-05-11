<?php

namespace App\Services\Interface;

abstract class GetRequest
{
    public function __construct()
    {}

    public function loadData(string $uri, array $options = []): array
    {
        $params = "?";
        foreach ($options as $key => $value) {
            $params .= "&" . $key . "=" . $value;
        }
        $finalUrl = $uri . $params;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $finalUrl,
            CURLOPT_RETURNTRANSFER => true, // Return the transfer as a string
            CURLOPT_HTTPGET => true, // Set request type to GET
            CURLOPT_SSL_VERIFYPEER => false, // Set to true if you're accessing an HTTPS URL and don't have valid certificates
        ));

        $response = curl_exec($curl);

        if(curl_errno($curl)){
            // Handle errors
            $error_message = curl_error($curl);
            curl_close($curl);
            throw new \Exception($error_message);
        }

        curl_close($curl);

        $resultData = json_decode($response, true);

      return $resultData;
    }
}