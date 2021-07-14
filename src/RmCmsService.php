<?php

namespace RmTop\RmCmsService;


require_once dirname(__DIR__)."./config/version.php";

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
        $this->registerRoutes(function (){
            Route::get('install', function () {
                return redirect('/install');
            });
            Route::get('step/[:step]', 'index/step');
            Route::post('step/[:step]', 'index/step');
            Route::post('dbtest/[:test]', 'index/test')->ajax();
            Route::post('step/finish', 'index/step/finish')->token();
            Route::get('step/finish', 'index/step/finish')->token();
            Route::get('finish', 'index/build')->ajax();
            Route::post('build', 'index/build')->ajax();
            Route::post('delInstall', 'index/delInstall')->ajax();
        });


    }



}