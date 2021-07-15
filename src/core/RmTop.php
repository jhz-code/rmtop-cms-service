<?php

namespace RmTop\RmCmsService\core;

use RmTop\RmCmsService\lib\RmDb;
use RmTop\RmCmsService\lib\RmEve;
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
        $sys['Agree']=  self::getAgree();
        View::assign('sys',$sys);
    }


    /**
     * 检测当前服务器环境
     */
    static function checkEnv(){
       return RmEve::env_check();
    }


    /**
     * 测试数据库连接
     * @return \PDO|null
     * @throws \ErrorException
     */
    static function getMysqlConn(): ?\PDO
    {
        $params = request()->param();
        return RmDb::get_mysql_conn($params);
    }

}