<?php

namespace RmTop\RmCmsService;

use RmTop\RmCmsService\core\RmTop;
use RmTop\RmCmsService\lib\RmClient;
use think\facade\Route;
use think\Service;


class RmCmsService extends Service
{
    /**
     * 注册路由
     * 注册全局配置
     */
    public function register()
    {
        $this->app->bind('RmTopCms', RmTop::class);
        $this->sys_ini();

    }


    /**
     *
     */
    public function sys_ini(){
        RmTop::SysInfo();//获取系统基础信息
        RmClient::sendAuth();
    }


}