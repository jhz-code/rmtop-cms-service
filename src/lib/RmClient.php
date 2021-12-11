<?php

namespace RmTop\RmCmsService\lib;

use GuzzleHttp\Client;
use think\facade\Request;

class RmClient
{


    protected Client $client;

    /**
     * 初始化Client
     */
    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://check.rmsf.top/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }


    public function sendAuth(){
        $webHost['host'] = Request::host();
        $webHost['port'] = Request::port();
        $this->client->request('GET','',$webHost);
    }









}