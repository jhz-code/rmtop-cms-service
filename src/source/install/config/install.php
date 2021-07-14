<?php


return [
    'env_items'=>[
        'os' => array('c' => 'PHP_OS','n'=>'操作系统', 'r' => 'noRestriction', 'b' => '建议使用Linux系统以提升程序性能','rs'=>'正在检测'),
        'server' => array('c' => 'SERVER_SOFTWARE','n'=>'服务器环境', 'r' => 'apache/nginx', 'b' => 'apache2.0以上/nginx1.6以上','rs'=>'正在检测'),
        'php' => array('c' => 'PHP_VERSION','n'=>'PHP版本', 'r' => '7.1.0', 'b' => '>7.1.0','rs'=>'正在检测'),
        'pdo' => array('c' => 'pdo','n'=>'PDO扩展', 'r' => '启用', 'b' => '必须开启','rs'=>'正在检测'),
        'session' => array('c' => 'session','n'=>'session', 'r' => '开启', 'b' => '开启 session.auto_start','rs'=>'正在检测'),
        'safe_mode' => array('c' => 'safe_mode','n'=>'safe_mode', 'r' => 'noRestriction', 'b' => '基础配置','rs'=>'正在检测'),
        'gd' => array('c' => 'gd_info','n'=>'GD库', 'r' => '1.0', 'b' => '必须开启','rs'=>'正在检测'),
        'curl' => array('c' => 'curl','n'=>'CURL库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
        'fileinfo' => array('c' => 'finfo_open','n'=>'fileinfo库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
        'openssl' => array('c' => 'openssl','n'=>'openssl库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
        'bcmath' => array('c' => 'bcmath','n'=>'bcmath库', 'r' => '启用', 'b' => '必须扩展','rs'=>'正在检测'),
        'OPcache' => array('c' => 'opcache_get_configuration','n'=>'OPcache库', 'r' => 'noRestriction', 'b' => '启用','rs'=>'正在检测'),

        'file_uploads' => array('c' => 'file_uploads','n'=>'附件上传', 'r' => 'noRestriction', 'b' => '>2M','rs'=>'正在检测'),
        'disk_space' => array('c' => 'disk_free_space','n'=>'硬盘空间', 'r' => file_size_format(30 * 1048576), 'b' => '>100MB','rs'=>'正在检测'),
    ],

    'function_items'=>[
        'pdo_mysql' => array('c' => 'pdo_mysql','n'=>'pdo_mysql()', 'b' => '必须','rs'=>'正在检测'),
        'file_put_contents' => array('c' => 'file_put_contents','n'=>'file_put_contents()',  'b' => '必须'),
        'file_get_contents' => array('c' => 'file_get_contents','n'=>'file_get_contents()',  'b' => '必须'),
        'xml_parser_create' => array('c' => 'xml_parser_create','n'=>'xml_parser_create()',  'b' => '必须'),
        'gethostbyname' => array('c' => 'gethostbyname','n'=>'gethostbyname()',  'b' => '必须'),
        'fsockopen' => array('c' => 'fsockopen','n'=>'fsockopen()',  'b' => '必须'),
        'imagettftext' => array('c' => 'imagettftext','n'=>'imagettftext()',  'b' => '必须'),

    ],






];