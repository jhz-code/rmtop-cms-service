<?php

namespace RmTop\RmCmsService\core;

use think\facade\View;

class RmTop extends Base
{

    public function __construct()
    {

    }


    static function SysInfo(){
        $sys['Name'] = self::getSystemName();
        $sys['Version']=  self::getVersion();
        $sys['Copyright']=  self::getCopyright();
        $sys['Host']=  self::getSystemHost();
        $sys['Email']=  self::getSystemEmail();
        $sys['Phone']=  self::getSystemPhone();
        View::assign('sys',$sys);
    }


}