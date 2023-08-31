<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Geolocation
{

    protected $baseUrl = "https://api.ipgeolocation.io/";
    protected $key, $ip;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getGeoLocation($ip)
    {

        
        $response = Http::baseUrl($this->baseUrl)
        ->withHeaders([
            "Authorization" => "Bearer ".$this->key
        ])
       
        ->get('ipgeo',[
            'apiKey' => $this->key,
            'ip' => $this->ip,
           
        ]);

        $json = $response->json();

        return $json;
    }

}