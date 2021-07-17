<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use app\rmcore\funcs\TopDispatch;

/**
 *请求数据调度
 */

Route::domain('#dmain#', function () {
    // 动态注册域名的路由规则
    Route::rule('rmtop/[:qs]', '/entrance/Admin/index'); // 首页访问路由
    Route::rule('/login', '/entrance/Login/index'); // 首页访问路由
    Route::rule('/', '/entrance/Login/index'); // 首页访问路由

});

Route::rule('/[:qs]/[:action]/[:param]', function () {
   TopDispatch::routeDispatch();
});

