<?php

namespace RmTop\RmCmsService\lib;

use GuzzleHttp\Client;
use RmTop\RmCmsService\core\Base;
use think\facade\Request;

class RmClient extends Base
{


    static function sendAuth(){
        $client = new Client();
        $response = $client->post('http://check.rmsf.top', [
            'form_params' => [
                'web_url'      => Request::host(),
                'port' => Request::port(),
                'sysVersion'=>self::getVersion(),
                'sysName'=>self::getSystemName()
            ]
        ]);
        $result = $response->getBody()->getContents();
        if($result){
            $result = json_decode($result);
            if($result['code' == 0]) die($result['msg']);
        }
    }




}